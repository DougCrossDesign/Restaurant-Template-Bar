<?php
namespace Model;

use BaseModel;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Input;
use Model\Pages\Page;

/**
 * Class User
 * @property int id
 * @property string created_at
 * @property string updated_at
 * @property string username
 * @property string fullname
 * @property string email
 * @property string password
 * @property string token
 * @property string token_expires
 * @property int userlevel
 * @property bool central_auth
 * @property bool enabled
 * @package Model
 */
class User extends BaseModel {

    /**
     * User types. Jumping by increments of tens to leave wiggle room for addition types that we might think of.
     */
    const TYPE_ALL = 0;
    const TYPE_AYC_ADMIN = 10;
    const TYPE_AYC_USER = 20;
    const TYPE_CLIENT_ADMIN = 30;
    const TYPE_CLIENT_USER = 40;

    public static function TYPES(){
        return [
            "None" => static::TYPE_ALL,
            "AYC Admin" => static::TYPE_AYC_ADMIN,
            "AYC User" => static::TYPE_AYC_USER,
            "Admin" => static::TYPE_CLIENT_ADMIN,
            "User" => static::TYPE_CLIENT_USER,
        ];
    }

    public static function getUserLevelName($num){
        foreach(static::TYPES() as $typename => $typenum){
            if($typenum == $num) return $typename;
        }
        return '';
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_users";

    /**
     * The model's attributes and their default values, if applicable.
     *
     * @var array
     */
    protected $attributes = [
        'username' => '',
        'fullname' => '',
        'email' => '',
        'password' => '',
        'token' => null,
        'token_expires' => null,
        'central_auth' => false,
        'enabled' => true,
        'userlevel' => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
        'token',
        'token_expires',
        'central_auth',
        'enabled',
        'userlevel'
    ];

    /**
     * @return array
     */
    public function getModuleNames(){
        $output = [];
        foreach($this->activeModules as $moduleName){
            $output[] = $moduleName->module;
        }
        return $output;
    }

    public function getPageIds(){
        $output = [];
        foreach($this->activePages()->get() as $page){
            $output[] = $page->id;
        }
        return $output;
    }

    protected function setCustomValues(){
        // handle custom set pages
        $this->activePages()->detach();
        if(is_array(Input::post("pageids"))){
            $ids = Input::post("pageids");
            foreach($ids as $id){
                $this->activePages()->attach($id);
            }
        }

        // handle custom set modules
        /** @var UserModulePermission $module */
        foreach($this->activeModules as $module){
            $module->delete();
        }
        if(is_array(Input::post("moduleids"))){
            $modules = Input::post("moduleids");
            foreach($modules as $modulename){
                $this->activeModules()->create([
                    'module' => $modulename
                ]);
            }
        }
    }


    /**
     * Checks whether the current user is part of a level or series of levels.
     *
     * @param $levels       int[]|int       Level Number or Array of Levels
     *
     * @return bool
     */
    public function userIsInLevel($levels){
        if(!is_array($levels)) $levels = [$levels];

        return in_array($this->userlevel, $levels);
    }

    /**
     * Check the validity of our current attributes. Usually is called
     * automatically before a save, but can be called manually.
     *
     * @return bool
     */
    public function validate() {
        $validator = new \Validation($this->attributes);

        $validator->field("username")
            ->required("Please enter a user name")
            ->wordsnumbers("Please do not use special characters")
            ->max("The username cannot be more than 60 characters", 60);

        if (!$this->attributes['central_auth']) {
            $validator->field("fullname")
                ->required("Please enter a name")
                ->plaintext("Please do not use special characters")
                ->max("A user's name cannot be more than 100 characters", 100);

            $validator->field("email")
                ->required("Please enter an email address")
                ->plaintext("Please do not use special characters")
                ->email("Please use the email format, eg. user@example.com")
                ->max("The username cannot be more than 60 characters", 60);
        }

        // if we haven't been created yet, enforce a password being entered
        if (!$this->exists) {
            $validator->field("password")
                ->required("Please enter a password")
                ->plaintext("Please do not use special characters");
        }

        $this->errors = $validator->errors();

        return parent::validate();
    }

    /**
     * Perform any data alterations or additional checks before we commit
     * to the database. Leaf classes can abort the save by returning a
     * value of false.
     *
     * @return bool
     */
    public function preSave() {
        /**
         * If the password in memory is not currently encoded, do so here.
         * Don't store the raw password in the database.
         */
        $info = password_get_info($this->attributes['password']);
        if ($info['algo'] === 0) {
            $password = Auth::generateHash($this->attributes['password']);
            if ($this->original['password'] !== $password) {
                $this->attributes['password'] = $password;
            }
        }

        return true;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeEnabled($query) {
        return $query->where('enabled', '=', '1');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeDisabled($query) {
        return $query->where('enabled', '=', '0');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeLocal($query) {
        return $query->where('central_auth', '=', '0');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeCentral($query) {
        return $query->where('central_auth', '=', '1');
    }


    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeSortAscending($query) {
        return $query->orderBy('username', 'ASC')->get();
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeSortDescending($query) {
        return $query->orderBy('username', 'DESC')->get();
    }

    public function activePages(){
        return $this->manyToMany("\Model\Pages\Page", "cms_core_module_users_pages", "userid", "pageid", "id");
    }

    public function activeModules(){
        return $this->hasMany("\Model\UserModulePermission", "userid", "id");
    }

    /**
     * Alias for Auth::getUserName
     *
     * @deprecated      Use Auth::getUserName instead
     * @return      string      The current logged in user's name
     */
    public static function getUserName(){
        return Auth::getUserName();
    }

    /**
     * Alias for Auth::getUser
     *
     * @return User|null
     * @deprecated      Use Auth::getUser instead
     */
    public static function getUser(){
        return Auth::getUser();
    }
}
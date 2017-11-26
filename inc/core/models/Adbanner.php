<?php

namespace Model;

use BaseModel;
use Controller\Mms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use stdClass;

/**
 * Class Siteinfo
 *
 * @package Model
 * @property string name        The name of the banner
 * @property string url         The URL the banner should lead to
 * @property string image       The banner image
 * @property string imagealt    The banner image alt tag
 * @property int impressions    Number of impressions
 * @property int clicks         Number of clicks
 * @property int start_date     Start date of the banner
 * @property int end_date       End date of the banner
 * @property int group_id       ID of the banner position
 * @property int size_id
 * @property bool newwindow
 */
class Adbanner extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_ad_banners";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the name of the banner."],
        'url' => ['', "Please enter the URL where the banner should lead to."],
        'image' => ['', "Please upload an image."],
        "imagealt" => '',
        'impressions' => 0,
        'clicks' => 0,
        'start_date' => 0,
        'end_date' => 0,
        'group_id' => 0,
        'size_id' => 0,
        'newwindow' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'image',
        'imagealt',
        'impressions',
        'clicks',
        'start_date',
        'end_date',
        'group_id',
        'size_id',
        'newwindow'
    ];

    protected $imageFields = ['image'];
    public $imageFolder = "adbanners";

    public static function getActivesByGroupId($groupids = []){
        $data = [];
        foreach($groupids as $id){
            $data[$id] = [];
        }

        /** @var AdbannerGroup $group */
        $groups = AdbannerGroup::with('adbanners')->whereIn("id", $groupids);
        if($groups->count()){
            foreach($groups->get() as $group){
                $query = $group->adbanners()->where("start_date", "<", time())->where("end_date", ">", time());
                if($query->count()){
                    $data[$group->id] = $query->get();
                }
            }
            return $data;
        } else {
            return null;
        }

    }

    public static function getActiveByGroupId($groupid){
        /** @var AdbannerGroup $group */
        $group = AdbannerGroup::with('adbanners')->where("id", $groupid)->first();
        $adbanners = $group->adbanners()->where("start_date", "<", time())->where("end_date", ">", time());
        return $adbanners->count() ? $adbanners->get() : null;
    }

    public static function getByGroupId($groupid){
        /** @var AdbannerGroup $group */
        $group = AdbannerGroup::getById($groupid);
        $adbanners = $group->adbanners();
        return $adbanners->count() ? $adbanners->get() : null;
    }

    protected function setCustomValues(){
        $this->newwindow = \Input::post("newwindow") ?: 0;

        if(\Input::post("group")){
            $this->groups()->detach();
            foreach(\Input::post("group") as $groupid){
                $this->groups()->attach($groupid);
            }
        }

        // check if we have set the size different
        if($this->id) {
            $copy = Adbanner::getById($this->id);
            if ($this->size_id != $copy->size_id) {
                $this->groups()->detach();
            }
        }
    }

    /**
     * @return BelongsToMany|null
     */
    public function groups(){
        return $this->manyToMany("\Model\AdbannerGroup", "cms_core_module_ad_banner_to_groups", "banner_id", "group_id", "id");
    }

    public function size(){
        $sizes = $this->hasOne("\Model\AdbannerSize", "id", "size_id");
        return $sizes->count() ? $sizes->first() : null;
    }

    function getGroupNames(){
        $output = [];
        /** @var AdbannerGroup $group */
        foreach($this->groups()->get() as $group){
            $output[] = $group->name;
        }
        return implode(', ', $output);
    }

    /**
     * Gets the real URL and logs an impression
     *
     * @return string
     */
    public function getUrl(){
        $this->logImpression();

        return "/mms/visit/" . $this->id;
    }

    public function logImpression(){
        $this->impressions()->create([
            'adbanner_id' => $this->id,
            'time' => time(),
            'ip' => Mms::getIpAddress()
        ]);
    }

    public function castForDatabase(){
        $this->start_date = strtotime($this->start_date);
        $this->end_date = strtotime($this->end_date);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function impressions(){
        return $this->hasMany("\Model\AdbannerImpression", "adbanner_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clicks(){
        return $this->hasMany("\Model\AdbannerClick", "adbanner_id");
    }

    public function getImpressions(){
        return $this->impressions()->count();
    }

    public function getClicks(){
        return $this->clicks()->count();
    }
}
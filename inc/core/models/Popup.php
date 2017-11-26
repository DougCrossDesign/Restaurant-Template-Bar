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
 * Class Popup
 *
 * @package Model
 * @property string title
 * @property int start
 * @property int end
 * @property string image
 * @property string imagealt
 * @property string link
 * @property bool newwindow
 */
class Popup extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_popups";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'title' => ['', 'Please enter the title of the popup.'],
        'start' => [0, 'Please enter the start date of the popup.'],
        'end' => [0, 'Please enter the end date of the popup.'],
        'image' => ['', 'Please upload an image for the popup.'],
        'imagealt' => ['', 'Please upload an image description.'],
        'link' => '',
        'newwindow' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'start',
        'end',
        'image',
        'imagealt',
        'link',
        'newwindow'
    ];

    /**
     * Returns an active popup or null
     *
     * @return Popup|null
     */
    public static function getActive(){
        $popups = static::where('start', "<", time())->where('end', ">", time());
        if($popups->count()){
            $popup = $popups->first();
            // now check if we have a cookie with this ID
            if(!isset($_COOKIE['popup' . $popup->id])){
                // if not, return this popup
                setcookie("popup" . $popup->id, true, time() + (2000000));
                return $popup;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    protected $imageFields = ['image'];
    public $imageFolder = "popups";

    protected function setCustomValues(){
        $this->newwindow = \Input::post("newwindow") ?: 0;
    }

    public function castForDatabase(){
        $this->start = strtotime($this->start);
        $this->end = strtotime($this->end);
    }
}
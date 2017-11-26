<?php

namespace Model;

use BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class AdbannerGroup
 *
 * @package Model
 * @property string name        The name of the banner
 * @property int width
 * @property int height
 */
class AdbannerGroup extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_ad_banner_groups";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the name of the banner group."],
        'width' => [0, "Please enter the width of this banner group."],
        'height' => [0, "Please enter the height of this banner group."]
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'width',
        'height'
    ];


    /**
     * @return BelongsToMany|null
     */
    public function adbanners(){
        return $this->manyToMany("\Model\Adbanner", "cms_core_module_ad_banner_to_groups", "group_id", "banner_id", "id");
    }

    protected $imageFields = [];
    public $imageFolder = "";

    /**
     * Returns ad banner groups that match the size of the ad banner size id
     *
     * @param int $size_id
     *
     * @return AdbannerGroup[]
     */
    public static function getBySize($size_id){
        $size = AdbannerSize::getById($size_id);
        $width = $size->width;
        $height = $size->height;

        $groups = AdbannerGroup::where('width', '=', $width)->where('height', '=', $height);
        if($groups->count()){
            return $groups->get();
        } else {
            return [];
        }
    }
}
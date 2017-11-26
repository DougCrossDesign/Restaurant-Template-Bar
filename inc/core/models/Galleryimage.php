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
 * Class Menusection
 *
 * @package Model
 * @property int menu_section_id
 * @property string title
 * @property string image
 * @property int displayorder
 */
class Galleryimage extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_gallery_images";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'gallery_album_id' => 0,
        'title' => '',
        'image' => ["", "Please upload an image."],
        'displayorder' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'gallery_album_id',
        'title',
        'image',
        'displayorder'
    ];

    protected $imageFields = ['image'];
    public $imageFolder = "galleries";

    /** Sets this model to the last in its group by ordering by $displayOrderField */
    public function setOrderToLast($displayOrderField){
        if(isset($this->$displayOrderField) && strlen($this->$displayOrderField)) {
            $this->{$displayOrderField} = static::where("gallery_album_id", "=", $this->gallery_album_id)->count() + 1;
        }
    }
}
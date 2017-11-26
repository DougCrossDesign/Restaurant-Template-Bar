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
 * Class Gallery
 *
 * @package Model
 * @property string name
 * @property int displayorder
 */
class Gallery extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_galleries";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the name of the gallery."],
        'displayorder' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'displayorder'
    ];

    protected $imageFields = ['image'];
    public $imageFolder = "galleries";


    public function albums(){
        return $this->hasMany("\Model\Galleryalbum", "gallery_id", "id");
    }

    public function getFirstAlbumName(){
        $albums = $this->albums()->orderBy("displayorder", "asc");
        if($albums->count()){
            return $albums->first()->name;
        } else {
            return 'Galleries';
        }
    }
}
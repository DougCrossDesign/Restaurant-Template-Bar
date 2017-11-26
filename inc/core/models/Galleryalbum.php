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
 * @property int gallery_id
 * @property string name
 * @property string text
 * @property int displayorder
 */
class Galleryalbum extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_gallery_albums";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'gallery_id' => 0,
        'name' => ['', "Please enter the name of the section."],
        'text' => '',
        'displayorder' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'gallery_id',
        'name',
        'text',
        'displayorder'
    ];

    protected $imageFields = ['image'];
    public $imageFolder = "galleries";

    public function setValues($attributes){
        parent::setValues($attributes);

        if($this->id) $this->handleItems();
    }

    protected function handleItems(){
        // handle items
        if(strlen(\Input::post("image_displayorder")[0])){
            /** @var Galleryimage $image */
            foreach($this->images()->getResults() as $image){
                $image->delete();
            }

            $i = 0;
            foreach(\Input::post("image_displayorder") as $order){
                if(\Input::post("image_delete")[$i]){
                    $i++;
                    continue;
                }
                $title = isset($_POST["image_title"][$i]) ? \Input::post("image_title")[$i] : $this->images()->count() + 1;
                $image = !strlen($_FILES['image_image']['name'][$i]) ? \Input::post("image_imagefile")[$i] : $this->uploadImageFileInto($_FILES['image_image'], $i, "galleries");

                if(strlen($image)) {
                    $item = $this->images()->create([
                        "title"      => $title,
                        "image"       => $image,
                        'displayorder' => $order
                    ]);
                    $item->save();
                }
                $i++;
            }
        }
    }

    /** Sets this model to the last in its group by ordering by $displayOrderField */
    public function setOrderToLast($displayOrderField){
        if(isset($this->$displayOrderField) && strlen($this->$displayOrderField)) {
            $this->{$displayOrderField} = static::where("gallery_id", "=", $this->gallery_id)->count() + 1;
        }
    }

    public function images(){
        return $this->hasMany("\Model\Galleryimage", "gallery_album_id", "id");
    }

}
<?php

namespace Model\Ecom;

use BaseModel;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/25/2016
 * Time: 5:36 PM
 */
class Product extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_ecom_products";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'manufacturer_id' => 0,
        'active' => 1,
        'deleted' => 0,
        'metatitle' => '',
        'metakeywords' => '',
        'metadescription' => '',
        'title' => ['', 'Please enter a title.'],
        'description' => '',
        'searchterms' => '',
        'price' => 0,
        'weight' => 0,
        'length' => 0,
        'width' => 0,
        'height' => 0,
        'shipping_times_id' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'manufacturer_id',
        'active',
        'deleted',
        'metatitle',
        'metakeywords',
        'metadescription',
        'title',
        'description',
        'searchterms',
        'price',
        'weight',
        'length',
        'width',
        'height',
        'shipping_times_id'
    ];

    public function setCustomValues(){
        // maybe handle date?
    }

    protected $imageFields = [];

    public function castForDatabase(){

    }

    public function postCreate(){

    }

    protected $relatedProducts = null;

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = true;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "products";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "products";

    public function getSummary(){
        return \Util::generateSummary($this->description, 100);
    }

    public function postSave()
    {
        parent::postSave();

        if(\Input::post("categoryid")){
            $this->categories()->detach();
            foreach(\Input::post("categoryid") as $id){
                $this->categories()->attach($id);
            }
        }

        if(\Input::post("relatedproductid")){
            $this->wipeRelatedProductRelationships();

            foreach(\Input::post("relatedproductid") as $id){
                $this->relatedProductsRelationship()->attach($id);
            }
        }

    }

    public function images(){
        return $this->hasMany("\Model\Ecom\ProductImage", "product_id", "id");
    }
    public function videos(){
        return $this->hasMany("\Model\Ecom\ProductVideo", "product_id", "id");
    }
    public function documents(){
        return $this->hasMany("\Model\Ecom\ProductDocument", "product_id", "id");
    }
    public function categories(){
        return $this->manyToMany("\Model\Ecom\Category", "cms_core_ecom_products_categories", "product_id", "category_id", "id");
    }
    public function relatedProductsRelationship(){
        return $this->manyToMany("\Model\Ecom\Product", "cms_core_ecom_products_related", "product_id", "related_id", "id");
    }
    public function manufacturer(){
        return $this->hasOne("\Model\Ecom\Manufacturer", "id", "manufacturer_id");
    }
    public function isInCategory($categoryId){
        foreach($this->categories as $category){
            if($category->id == $categoryId) return true;
        }
        return false;
    }
    public function wipeRelatedProductRelationships(){
        /** @var \Config $config */
        $config = config();
        $config->getConnection()->delete("delete from cms_core_ecom_products_related where product_id = :id1 or related_id = :id2", ["id1" => $this->id , "id2" => $this->id]);
    }
    public function isRelatedToProduct($productid){
        // do one call first to cache products
        if(!$this->relatedProducts) {
            /** @var \Config $config */
            $config = config();
            $this->relatedProducts = $config->getConnection()->select("select * from cms_core_ecom_products_related where product_id = :id1 or related_id = :id2",
                ["id1" => $this->id, "id2" => $this->id]);
        }

        foreach($this->relatedProducts as $row){
            if($row->product_id == $productid || $row->related_id == $productid) return true;
        }
        return false;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 1/6/2016
 * Time: 6:00 PM
 */

namespace Model;


class SitemapItem
{
    public $title;
    protected $url;
    public $children;

    /**
     * @param $title        string
     * @param $url          string
     * @param $children     array
     */
    public function __construct($title, $url, $children){
        $this->title = $title;
        $this->url = $url;
        $this->children = $children;
    }
    public function render(){
        $output = '<li><a href="'. $this->url .'">'. $this->title .'</a>';
        if(count($this->children)){
            $output .= '<ul>';
            /** @var SitemapItem $child */
            foreach($this->children as $child){
                $output .= $child->render();
            }
            $output .= '</ul>';
        }
        $output .= '</li>';
        return $output;
    }
}
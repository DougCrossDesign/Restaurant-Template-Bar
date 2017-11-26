<?php

use Illuminate\Database\Eloquent\Collection;


/**
 * Paginator that takes a simple array
 */
class ArrayPaginator
{

    /** @var array  */
    public $entries;
    public $entriesPerPage;

    /**
     * @param Collection $entries
     * @param int $entriesPerPage
     */
    public function __construct($entries, $entriesPerPage = 30){
        $this->entries = $entries;
        $this->entriesPerPage = $entriesPerPage;
    }
    public function get(){
        // see if: "page" is set
        if(!Input::get('page') || Input::get('page') == 1){
            // show first page
            $pageNum = 1;
        } else {
            // show N page
            $pageNum = (int) Input::get('page');
        }
        $start = ($pageNum - 1) * $this->entriesPerPage;
        return array_slice($this->entries, $start, $this->entriesPerPage);
    }
    public function getHtml(){
        if(!Input::get('page') || Input::get('page') == 1){
            // show first page
            $pageNum = 1;
        } else {
            // show N page
            $pageNum = (int) Input::get('page');
        }
        $length = count($this->entries);
        $numPages = ceil($length / $this->entriesPerPage);
        if($numPages <= 1) return '';
        $output = "<div><ul class=\"admin-paginator\">";
        if($pageNum != 1) $output .= '<li><a href="?page='. ($pageNum - 1) .'">Prev</a></li>';
        for($i = 0; $i < $numPages; $i++){
            $output .= '<li>';
            if($i+1 != $pageNum) $output .= '<a href="?page='. ($i+1) .'">';
            $output .=  $i+1;
            if($i+1 != $pageNum) $output .= '</a>';
            $output .= '</li>';
        }
        if($numPages > $pageNum && $pageNum != $numPages) $output .= '<li><a href="?page='. ($pageNum + 1) .'">Next</a></li>';
        $output .= "</ul></div>";
        return $output;
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/26/2016
 * Time: 11:03 AM
 */
class InputTabGroupBuilder
{
    /**
     * @var InputTab[]
     */
    public $tabs;
    public $tabGroupName;

    /**
     * InputTabGroupBuilder constructor.
     *
     * @param $tabs         InputTab[]      Array of tabs
     * @param $tabName      string          The optional name of this tab group
     */
    public function __construct($tabs, $tabGroupName){
        $this->tabs = $tabs;
        $this->tabGroupName = $tabGroupName;
    }

    public function output(){
        echo '<div class="tabgroup">';

            // first output tabs up top
            echo '<div class="tabheader" data-tabgroup="'. $this->tabGroupName .'">';

            $i = 0;
            /** @var InputTab $tab */
            foreach($this->tabs as $tab){
                echo '<a data-tab="' . $tab->tabName . '" ';
                if($i == 0) echo ' class="active" ';
                echo '>' . $tab->tabName . '</a>';
                $i++;
            }
            echo '</div>';

            // then output divs down below
            echo '<div class="tabcontents" data-tabgroup="'. $this->tabGroupName .'">';
            $i = 0;
            /** @var InputTab $tab */
            foreach($this->tabs as $tab){
                echo '<div data-tab="' . $tab->tabName . '"';
                if($i == 0) echo ' class="active" ';
                echo ' >';
                $tab->output();
                echo "</div>";
                $i++;
            }
            echo '</div>';

        echo "</div>";
    }
}
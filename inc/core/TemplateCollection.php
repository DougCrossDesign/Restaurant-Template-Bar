<?php

/**
 * Class TemplateCollection
 *
 * A class that accepts multiple Templates in the constructor and can be acted on as if it were a Template
 */
class TemplateCollection implements TemplateInterface
{
    protected $templates = [];

    public function __construct($templates){
        if(!is_array($templates)){
            $templates = func_get_args();
        }
        $this->templates = $templates;
    }

    /**
     * Renders all templates in the collection and returns the formatted HTML
     *
     * @return string       Rendered formatted HTML
     */
    public function render(){
        $output = '';
        /** @var Template $template */
        foreach($this->templates as $template){
            $output.= $template->render();
        }
        return $output;
    }

    /**
     * Sets the theme of all the templates
     *
     * @param string $theme
     */
    public function setTheme($theme){
        /** @var Template $template */
        foreach($this->templates as $template){
            $template->setTheme($theme);
        }
    }
}
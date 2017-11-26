<?php
class MetaData {

    /** @var string */
    public $title = "";

    /** @var array  */
    public $keywords = [];

    /** @var string  */
    public $description = "";

    /**
     * Prepares a renderable template containing our page meta data.
     * @return Template
     */
    public function getTemplate() {
        $template = new Template("partials/metadata");

        $template->meta_title = !empty($this->title) ? $this->title : "AYC Media";
        $template->meta_keywords = implode(',', $this->keywords);
        $template->meta_description = $this->description;

        return $template;
    }
}
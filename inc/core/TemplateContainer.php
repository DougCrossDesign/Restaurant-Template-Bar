<?php
class TemplateContainer extends Object {

    /** @var string */
    protected $directory;

    /** @var string */
    public $tinymce_js = '';

    /** @var string */
    public $tinymce_css = '';

    /**
     * @param array $data
     * @param string $dir
     */
    public function __construct($data, $dir) {
        parent::__construct($data);
        $this->directory = $dir;

        $this->tinymce_css = $dir . 'tinymce/tinymce.css';
        $this->tinymce_js = $dir . 'tinymce/tinymce.min.js';
    }

    public function getError($key){
        if(isset($this->errors) && isset($this->errors[$key])){
            return $key;
        }
        return '';
    }

    /**
     * @param string $file
     * @return string
     */
    public function css($file) {
        $out = $this->directory . "css/{$file}";
        if (Response::DisableCaching)
            $out .= "?m=" . time();
        return $out;
    }

    /**
     * @param string $file
     * @return string
     */
    public function js($file) {
        $out = $this->directory . "js/{$file}";
        if (Response::DisableCaching)
            $out .= "?m=" . time();
        return $out;
    }

    /**
     * @param string $file
     * @return string
     */
    public function image($file) {
        return $this->directory . "images/{$file}";
    }

    /**
     * @param bool $value
     * @return string
     */
    public function bool($value) {
        $value = (bool)$value;
        return $value ? "true" : "false";
    }

    /**
     * @param $string
     * @return string
     */
    public function highlight($string) {
        return str_replace(array("&lt;?php", "?&gt;"),'', substr(highlight_string('<?php '.$string.' ?>', true), 36));
    }
}
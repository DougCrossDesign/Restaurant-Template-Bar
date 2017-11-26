<?php
/**
 * Class Template
 */
class Template implements TemplateInterface {

    const ADD = "add";

    /**
     * Data which will be passed to the template
     * @var array
     */
    protected $vars = array();

    /**
     * Template file to render
     * @var string
     */
    protected $file = "";

    /**
     * Which theme directory we will pull the template from
     * @var string
     */
    protected $theme = "";

    /**
     * Directory containing the specified template
     * @var string
     */
    public $directory = "";

    /**
     * @param string $file
     */
    public function __construct($file) {
        $this->file = $file;
        $config = config();
        $theme = $config->theme;
        $this->setTheme($theme);

        // check if we called "../add"
        $fileParts = explode("/", $file);
        if(end($fileParts) == static::ADD){
            // if so, see if "../add" exists
            $file = Util::formatPath($this->directory) . $this->file . TEMPLATE_EXT;
            if(!file_exists($file)){
                // if not, set it to modify instead
                $fileParts[count($fileParts)-1] = "edit";
                $this->file = implode("/", $fileParts);
            }
        }
    }

    /**
     * @param mixed $name
     * @return mixed|null
     */
    public function __get($name) {
        if (isset($this->vars[$name]))
            return $this->vars[$name];
        return null;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name) {
        return isset($this->vars[$name]);
    }

    /**
     * Set the template's theme
     *
     * @param string $theme
     */
    public function setTheme($theme) {
        $this->directory = TEMPLATE_DIR . '/' . $theme;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function render($forsearch = false) {
        $out = '';
        try {
            $file = Util::formatPath($this->directory) . $this->file . TEMPLATE_EXT;
            if (file_exists($file)) {
                ob_start();
                $to_root = str_replace(SYSTEM_DIR, '', Util::formatPath($this->directory));
                $obj = new TemplateContainer($this->vars, $to_root);
                $searchmode = $forsearch;
                require($file);
                // TODO can we just wrap every partial in a div with class if it exists? or will this break certain partials? ask Andrew
                $out .= ob_get_clean();
            } else {
                die('file not found:' . $file);
            }
        } catch (\Exception $e) {
            if (ob_get_length() > 0) {
                ob_end_clean();
            }
            Error::exception($e);
        }

        return $out;
    }
}
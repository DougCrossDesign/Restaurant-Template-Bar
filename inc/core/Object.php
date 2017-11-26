<?php
/**
 * Generic object container class
 *
 * Class Object
 */
class Object {
    /**
     * @var array
     */
    private $vars = null;

    /**
     * @param array $data
     */
    public function __construct($data = array()) {
        $this->vars = $data;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key) {
        if (isset($this->vars[$key]))
            return $this->vars[$key];
        return null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value) {
        $this->vars[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function __isset($key) {
        return isset($this->vars[$key]);
    }

    /**
     * @param $key
     */
    public function __unset($key) {
        unset($this->vars[$key]);
    }
}
<?php
namespace Response;

/**
 * Class JSON
 * @package Response
 */
class JSON extends \Response {

    /** @var array */
    protected $data;

    /**
     * @param array $data
     */
    public function __construct($data) {
        parent::__construct();

        $this->disableCaching = self::DisableCaching;

        $this->data = $data;
    }

    /**
     * Renders the current response to output.
     */
    public function render() {
        parent::render();
        header("Content-type: application/json; charset=utf-8");
        print json_encode($this->data);
    }
}
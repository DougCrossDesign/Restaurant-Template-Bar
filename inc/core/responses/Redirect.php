<?php
namespace Response;

/**
 * Class Redirect
 * @package Response
 */
class Redirect extends \Response {

    /** @var string */
    protected $url;

    /**
     * @param string $url
     * @param bool $permanent
     */
    public function __construct($url, $permanent = false) {
        parent::__construct();

        $this->disableCaching = self::DisableCaching;

        $this->url = $url;
        $this->code = $permanent ? 301 : 302;
    }

    /**
     * Renders the current response to output.
     */
    public function render() {
        parent::render();

        header("Location: {$this->url}");
    }
}
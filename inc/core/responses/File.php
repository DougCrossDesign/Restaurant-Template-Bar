<?php
namespace Response;

use Util;

/**
 * Class File
 * @package Response
 */
class File extends \Response {

    /** @var string */
    protected $name;

    /** @var string */
    protected $path;

    /**
     * @param string $name
     * @param string $path
     */
    public function __construct($path, $name) {
        parent::__construct();

        $this->disableCaching = self::DisableCaching;

        $this->name = $name;
        $this->path = $path;
    }

    /**
     * Renders the current response to output.
     */
    public function render() {
        parent::render();
        header("Content-Disposition: attachment; filename='{$this->name}'");
        print file_get_contents(Util::formatPath($this->path) . $this->name);
    }
}
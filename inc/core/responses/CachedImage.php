<?php
namespace Response;

use Util;
use Exception;

/**
 * Class CachedImage
 * @package Response
 */
class CachedImage extends \Response {

    /** @var string */
    protected $name;

    /** @var string */
    protected $path;

    /** @var string */
    protected $filePath;

    /** @var int */
    protected $lastModified;

    /**
     * @param string $name
     * @param string $path
     * @throws Exception
     */
    public function __construct($name, $path) {
        parent::__construct();

        $this->disableCaching = false;

        $this->name = $name;
        $this->path = $path;

        $this->filePath = Util::formatPath($this->path) . $this->name;
        if (!is_file($this->filePath))
            throw new Exception("File not found: {$this->filePath}");

        $this->lastModified = filemtime($this->filePath);

        $modifiedSince = 0;
        $headers = apache_request_headers();

        if (!empty($headers["If-Modified-Since"])) {
            $modifiedSince = strtotime($headers["If-Modified-Since"]);
        } else if (!empty($_SERVER["HTTP_IF_MODIFIED_SINCE"])) {
            $modifiedSince = strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"]);
        }

        if ($modifiedSince > 0 && $modifiedSince <= $this->lastModified) {
            $this->code = 304;
        }
    }

    /**
     * Renders the current response to output.
     */
    public function render() {
        parent::render();

        if ($this->code === 200) {
            header("Expires: " . date(DATE_RFC822, strtotime("+2 days", $this->lastModified)));
            header("Pragma: public");
            header("Cache-Control: public");
            header("Last-Modified: " . date(DATE_RFC822, $this->lastModified));

            header("Content-type: image/jpeg");
            header("Content-Disposition: filename='{$this->name}'");
            print file_get_contents($this->filePath);
        }
    }
}
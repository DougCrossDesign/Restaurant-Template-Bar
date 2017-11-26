<?php
use Response\PageTemplate;

/**
 * Class Response
 */
abstract class Response {

    /** Do we want to disable caching site wide?  */
    const DisableCaching = true;

    /** @var bool */
    protected $disableCaching = false;

    /** @var string Selected HTTP protocol */
    protected $protocol = "HTTP/1.0";

    /** @var int Selected HTTP response code */
    protected $code = 200;

    /** @var array Possible HTTP response codes and corresponding messages */
    protected static $codes = array(
        //Informational 1xx
        100 => '100 Continue',
        101 => '101 Switching Protocols',
        //Successful 2xx
        200 => '200 OK',
        201 => '201 Created',
        202 => '202 Accepted',
        203 => '203 Non-Authoritative Information',
        204 => '204 No Content',
        205 => '205 Reset Content',
        206 => '206 Partial Content',
        226 => '226 IM Used',
        //Redirection 3xx
        300 => '300 Multiple Choices',
        301 => '301 Moved Permanently',
        302 => '302 Found',
        303 => '303 See Other',
        304 => '304 Not Modified',
        305 => '305 Use Proxy',
        306 => '306 (Unused)',
        307 => '307 Temporary Redirect',
        //Client Error 4xx
        400 => '400 Bad Request',
        401 => '401 Unauthorized',
        402 => '402 Payment Required',
        403 => '403 Forbidden',
        404 => '404 Not Found',
        405 => '405 Method Not Allowed',
        406 => '406 Not Acceptable',
        407 => '407 Proxy Authentication Required',
        408 => '408 Request Timeout',
        409 => '409 Conflict',
        410 => '410 Gone',
        411 => '411 Length Required',
        412 => '412 Precondition Failed',
        413 => '413 Request Entity Too Large',
        414 => '414 Request-URI Too Long',
        415 => '415 Unsupported Media Type',
        416 => '416 Requested Range Not Satisfiable',
        417 => '417 Expectation Failed',
        418 => '418 I\'m a teapot',
        422 => '422 Unprocessable Entity',
        423 => '423 Locked',
        426 => '426 Upgrade Required',
        428 => '428 Precondition Required',
        429 => '429 Too Many Requests',
        431 => '431 Request Header Fields Too Large',
        //Server Error 5xx
        500 => '500 Internal Server Error',
        501 => '501 Not Implemented',
        502 => '502 Bad Gateway',
        503 => '503 Service Unavailable',
        504 => '504 Gateway Timeout',
        505 => '505 HTTP Version Not Supported',
        506 => '506 Variant Also Negotiates',
        510 => '510 Not Extended',
        511 => '511 Network Authentication Required'
    );

    /**
     * Initialize our protocol.
     */
    protected function __construct() {
        $this->protocol = getenv('SERVER_PROTOCOL');
    }

    /**
     * Set the response code that we will output.
     * @param int $code
     */
    public function setCode($code) {
        $this->code = $code;
    }

    /**
     * Renders the current response to output.
     */
    public function render() {
        $message = static::$codes[$this->code];
        header("$this->protocol $message");

        if ($this->disableCaching) {
            header("Cache-Control: no-cache, no-store, must-revalidate");
            if (strpos($this->protocol, 'HTTP/1.1', 0) !== false) {
                header('Cache-Control: post-check=0, pre-check=0', false);
            }

            header("Pragma: no-cache");
            header("Expires: 0");
        }
    }

    /**
     * Creates a generic 404 template
     * @return \Response\PageTemplate
     */
    public static function createGeneric404() {


        $template = new Template("pages/cms-all");
        return new PageTemplate($template);

        /*
        $template = new Template("Pages/cms-all");
        $template->page_title = "Page not found";
        $template->page_content = "You took a wrong turn or something, blah blah blah.";

        $response = new \Response\PageTemplate($template);
        $response->setCode(404);

        return $response;
        */
    }
}
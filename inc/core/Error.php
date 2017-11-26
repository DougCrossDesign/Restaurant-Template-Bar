<?php
use Model\Adbanner;
use Model\Footersitemenu;
use Model\Metadata;
use Model\Popup;
use Model\Siteinfo;
use Model\Sitemenu;
use Model\Sponsor;
use Response\PageTemplate;

class Error {

    public static $ERROR_LEVELS = [
        E_ERROR => "E_ERROR",
        E_WARNING => "E_WARNING",
        E_PARSE => "E_PARSE",
        E_NOTICE => "E_NOTICE",
        E_CORE_ERROR => "E_CORE_ERROR",
        E_CORE_WARNING => "E_CORE_WARNING",
        E_COMPILE_ERROR => "E_COMPILE_ERROR",
        E_COMPILE_WARNING => "E_COMPILE_WARNING",
        E_USER_ERROR => "E_USER_ERROR",
        E_USER_WARNING => "E_USER_WARNING",
        E_USER_NOTICE => "E_USER_NOTICE",
        E_STRICT => "E_STRICT",
        E_RECOVERABLE_ERROR => "E_RECOVERABLE_ERROR",
        E_DEPRECATED => "E_DEPRECATED",
        E_USER_DEPRECATED => "E_USER_DEPRECATED",
        E_ALL => "E_ALL"
    ];

    /**
     * On fatal errors, use the same error handling that we use for exceptions.
     */
    public static function fatal() {
        if ($e = error_get_last()) {
            Error::exception(new \ErrorException($e['message'], $e['type'], 0, $e['file'], $e['line']));
        }
    }

    const FRIENDLY_MESSAGES = "ErrorFriendlyMessages.json";

    /**
     * Handle all raised PHP errors.
     *
     * @param int $code
     * @param string $error
     * @param int $file
     * @param int $line
     * @return bool
     */
    public static function handler($code, $error, $file = 0, $line = 0) {
        // TODO - decide if we can have silent errors that don't show anything but do send emails?
        $min = config()->error_level_min;
        $max = config()->error_level_max;
        if($code < $max || $code > $min) return;

        $in_command_line = config()->cli;
        if (!$in_command_line && ob_get_length()) {
            ob_clean();
        }

        $message = "[$code] $error [$file] ($line)";

        // log error to file if set
        if(config()->error_log_to_file) log_error($message, $code);

        // email error if set
        if(config()->error_emails_enabled){
            $body = static::getErrorOutput($error, $file, $line);
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: no-reply@" . $_SERVER["HTTP_HOST"] . "\r\n";
            $headers .= "Reply-To: no-reply@" . $_SERVER["HTTP_HOST"] . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            mail(config()->error_email_address, "Error on " . $_SERVER["HTTP_HOST"], $body, $headers);
        }

        if ($in_command_line) {
            print $message;
        } else {
            // display error if set
            if(config()->error_display){
                // display friendly error page if set
                if(config()->error_display_error_page){
                    $template = self::getErrorTemplate($error, $file, $line, $code);
                    static::addFriendlyErrorMessage($template, $error);
                    static::addOptionalTemplateData($template);

                    $response = new \Response\PageTemplate(array("page" => $template));
                    //if (config()->debug) $response->enableStats();
                    $response->render();
                    die();
                } else {
                    die(static::getErrorOutput($error, $file, $line));
                }
            } else {
                return;
            }
        }

        exit(1);
    }


    //TODO Care to explain?
    protected static function addFriendlyErrorMessage(&$template, $error){
        if(!config()->error_display_error_page_friendly_message) return;

        $messages = json_decode(file_get_contents(__DIR__ . '/' . static::FRIENDLY_MESSAGES));
        foreach($messages as $search => $message){
            if(strstr($error, $search)){
                $template->friendly_error = $message;
                return;
            }
        }
        $template->friendly_error = '';
    }
    protected static function addOptionalTemplateData(&$template){

    }

    /**
     * Handle thrown exceptions.
     *
     * @param Exception $e
     */
    public static function exception(Exception $e) {
        // If the view fails, at least we can print this message!
        $message = "{$e->getMessage()} [{$e->getFile()}] ({$e->getLine()})";
        try {
            log_error($message, 0);

            if (config()->cli) {
                print $message;
            } else {
                $template = config()->debug ?
                    self::getExceptionTemplate($e) :
                    self::getGenericTemplate();

                $response = new \Response\PageTemplate($template);
                //if (config()->debug) $response->enableStats();
                //$response->setCode(500);
                $response->render();
            }

        } catch (Exception $e) {
            print $message;
        }

        exit(1);
    }

    /**
     * @return Template
     */
    private static function getGenericTemplate() {
        $template = new Template('pages\generic');
            $template->page_title = "Got an error lol";
            $template->page_content = "Don't call us, we'll call you.";

        return $template;
    }

    private static function getErrorOutput($error, $file, $line){
        $items = self::backtrace(2);

        // Eloquent embeds exceptions in the error trace, if we find an exception, treat it as such.
        foreach ($items as $item) {
            if (is_array($item['args'])) {
                foreach ($item['args'] as $arg) {
                    if ($arg instanceof \Exception) {
                        self::exception($arg);
                    }
                }
            }
        }

        $output = '
            <html><head></head><body>
            <style type="text/css">
                em {
                    font-weight: bold;
                    color: red;
                }
            </style>
            <h2>Error</h2><span>Message:</span> '. $error .'<br />
                    <span>File:</span>'. $file .':'. $line .'<br />
                    <span>Request: </span>http://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] .'<br />
                    <span>Backtrace:</span><ul>';
        foreach($items as $item) {
            $file = $item['file'];
            $line = $item['line'];
            $function = $item['function'];
            $class = isset($item['class']) ? $item['class'] : null;
            $source = $item['source'];
            $output .= '<li>
                <div class="error_message_top">
                    <b>'. $file . ' line:' . $line .'</b><br />
                    <i>
                        '. ($class ? $class : '') . '->' . ($function ? $function : '') . '()' . '
                    </i>
                </div>
                <pre>'. $source .'</pre>
            </li>';
        }
        $output .= '</ul></body></html>';
        return $output;
    }

    /**
     * @param string $error
     * @param string $file
     * @param int $line
     * @return Template
     */
    private static function getErrorTemplate($error, $file, $line, $code) {
        $template = new Template('pages/error');
        \Response\PageTemplate::$theme = "site";

        $items = self::backtrace(2);

        // Eloquent embeds exceptions in the error trace, if we find an exception, treat it as such.
        foreach ($items as $item) {
            if (isset($item['args']) && is_array($item['args'])) {
                foreach ($item['args'] as $arg) {
                    if ($arg instanceof \Exception) {
                        self::exception($arg);
                    }
                }
            }
        }

        $template->level = static::$ERROR_LEVELS[$code];
        $template->message = $error;
        $template->file = $file;
        $template->line = $line;
        $template->backtrace_items = $items;

        return $template;
    }

    /**
     * @param Exception $e
     * @return Template
     */
    private static function getExceptionTemplate(Exception $e) {
        $template = new Template("pages/exception");

        \Response\PageTemplate::$theme = "admin";

        $template->title = get_class($e);
        $template->message = $e->getMessage();
        $template->file = $e->getFile();
        $template->line = $e->getLine();

        $items = [[
            'file' => $template->file,
            'line' => $template->line,
            'function' => $template->title,
            'source' => self::source($template->file, $template->line)
        ]];

        foreach ($e->getTrace() as $item) {
            if (isset($item['file']) && isset($item['line'])) {
                $item['source'] = self::source($item['file'], $item['line']);
                $items[] = $item;
            }
        }

        $template->backtrace_items = $items;
        return $template;
    }

    /**
     * Fetch and HTML highlight several lines of a file.
     *
     * @param string $file to open
     * @param integer $number of line to highlight
     * @param integer $padding of lines on both side
     * @return string
     */
    private static function source($file, $number, $padding = 5) {
        // Get the content from the file
        $contents = file($file);

        // determine which segment of the file we want to return
        $first = $number - $padding - 1;
        $total = $padding * 2 + 1;

        if ($total > count($contents)) {
            $first = 1;
            $total = count($contents);
        } elseif ($first + $total > count($contents)) {
            $first = count($contents) - $total;
        } elseif ($first < 1) {
            $first = 1;
        }

        $lines = array_slice($contents, $first, $total, 1);

        // format the output
        $html = '';
        foreach ($lines as $i => $line) {
            $html .= "<span class='bold'>" . sprintf('%' . mb_strlen($number + $padding) . 'd', $i + 1) . '</span> '
                . ($i + 1 == $number ? '<em>' . htmlentities($line) . '</em>' : htmlentities($line));
        }

        return $html;
    }

    /**
     * Fetch a backtrace of the code
     *
     * @param int $offset to start from
     * @param int $limit of levels to collect
     * @return array
     */
    private static function backtrace($offset, $limit = null) {
        $trace = array_slice(debug_backtrace(), $offset, $limit);

        foreach ($trace as $item => &$value) {
            if (!isset($value['file'])) {
                unset($trace[$item]);
                continue;
            }

            $value['source'] = self::source($value['file'], $value['line']);
        }

        return $trace;
    }
}
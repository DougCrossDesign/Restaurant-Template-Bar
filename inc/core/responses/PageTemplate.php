<?php
namespace Response;

use Template;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class PageTemplate
 * @package Response
 */
class PageTemplate extends \Response {

    /** @var string */
    private $layout = null;

    /** @var array */
    private $templates = null;

    /** @var bool */
    private $tinymce = false;

    /** @var string */
    public static $theme = null;

    /** @var bool */
    private $showStats = false;

    /**
     * @param Template|array $templates
     * @param string $layout
     */
    public function __construct($templates, $layout = "layout") {
        parent::__construct();

        $this->disableCaching = self::DisableCaching;

        $this->layout = $layout;

        if (is_array($templates)) {
            $this->templates = $templates;
        } elseif ($templates instanceof \TemplateInterface) {
            $this->templates = ['page' => $templates];
        } else {
            throw new \InvalidArgumentException("The PageTemplate class expects either a single template or multiple templates.");
        }
    }

    /**
     * Toggle response including TinyMCE libraries in the template.
     *
     * @param bool $use
     */
    public function useTinyMCE($use = true) {
        $this->tinymce = $use;
    }

    /**
     * Toggle the display of the stats template in the layout template
     *
     * @param bool $use
     */
    public function enableStats($use = true) {
        $this->showStats = $use;
    }

    public function renderPart($vars = []){
        $content = '';

        $baseTemplate = new \Template("pages/base-template");
        $baseTemplate->setTheme(config()->theme);

        /**
         * @var string $name
         * @var \Template $template
         */
        foreach ($this->templates as $name => $template) {
            $theme = self::$theme;
            $template->setTheme($theme);
            $content .= $template->render();
        }

        $baseTemplate->page = $content;
        foreach($vars as $key => $value){
            $baseTemplate->{$key} = $value;
        }

        parent::render();
        header("Content-Type: text/html; charset=utf-8");

        echo $baseTemplate->render();
    }

    /**
     * Renders the current response to output.
     */
    public function render() {
        $content = '';

        /**
         * @var string $name
         * @var \Template $template
         */
        foreach ($this->templates as $name => $template) {
            $template->setTheme(self::$theme);
            $content .= $template->render();
        }

        parent::render();
        header("Content-Type: text/html; charset=utf-8");

        // filter $content if necessary

        echo $content;
    }

    /**
     * @return Template
     */
    private function buildStatsTemplate() {
        $template = new Template('partials\stats');
        $template->setTheme('AYC');

        $template->memory_current = number_format(memory_get_usage() - START_MEMORY_USAGE);
        $template->memory_process = number_format(memory_get_usage());
        $template->memory_process_peak = number_format(memory_get_peak_usage(true));

        $template->execution_time = round((microtime(true) - START_TIME), 5);
        $template->url_path = CURRENT_PATH;
        $template->timezone = date_default_timezone_get();

        $php_files = [];
        foreach (get_included_files() as $file) {
            $php_files[] = str_replace(SYSTEM_DIR, '', $file);
        }

        $template->php_files = $php_files;
        $template->number_of_php_files = count($php_files);

        $template->server = var_info($_SERVER);
        $template->session = var_info($_SESSION);
        if (count($_GET)) $template->get = var_info($_GET);
        if (count($_POST)) $template->post = var_info($_POST);

        $queries = [];
        foreach (DB::getQueryLog() as $query) {
            $statement = $query['query'];

            foreach ($query['bindings'] as $binding) {
                if (!is_numeric($binding)) $binding = "'$binding'";
                $statement = preg_replace('/\?/', $binding, $statement, 1);
            }

            $queries[] = [
                'statement' => $statement,
                'time' => $query['time']
            ];
        }
        $template->queries = $queries;

        return $template;
    }
}
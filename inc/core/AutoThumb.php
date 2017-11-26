<?php
use Response\CachedImage;

class AutoThumb {

    /** @var string */
    private $dir;

    /* @var AutoThumbConfig[] */
    private $config = [];

    /** @var array */
    private $extensions = ["jpg", "png", "gif", "bmp"];

    /** @var bool */
    private $refresh = false;

    /**
     * @param string $uniqueid
     * @param string $dir
     * @param array $extensions
     * @throws Exception
     */
    public function __construct($dir, array $extensions = null) {
        if (!is_dir($dir))
            throw new Exception("Can't find the source directory: {$dir}");

        $this->dir = $dir;

        // Initialize filename extensions.
        if ($extensions !== null)
            $this->extensions = $extensions;

        $this->extensions($this->extensions);
    }

    /**
     * Set the allowed extensions.
     *
     * @param array $extensions
     */
    public function extensions(array $extensions) {
        $this->extensions = [];
        foreach ($extensions as $key => $value) {
            $this->addExtension($value);
        }
    }

    /**
     * Returns a chain-able configuration object.
     *
     * @param string $alias
     * @param int $width
     * @param int $height
     * @param int $cropType
     * @param bool $scaleUp
     * @return AutoThumbConfig
     * @throws Exception
     */
    public function config($alias, $width, $height, $cropType = null, $scaleUp = null) {
        // Validate alias.
        $alias = $this->checkAlias($alias);

        // Add configuration and return for further modifications.
        $this->config[$alias] = new AutoThumbConfig($width, $height, $cropType, $scaleUp);

        return $this->config[$alias];
    }

    /**
     * A more direct way of setting auto thumbnail configuration.
     *
     * @param	string			$alias
     * @param	AutoThumbConfig	$config
     * @return	$this
     * @throws	Exception
     */
    public function addConfig($alias, AutoThumbConfig $config) {
        // Validate alias.
        $alias = $this->checkAlias($alias);

        // Add configuration and return self to allow adding of more alias configurations.
        $this->config[$alias] = $config;
        return $this;
    }

    /**
     * Adds an extension to the array of RegEx compatible filename extensions.
     *
     * @param string $extension
     */
    private function addExtension($extension) {
        $extension = trim(strtolower($extension));
        $extension = preg_quote($extension, "#");

        if ($extension === "jpg" || $extension === "jpeg")
            $extension = "jpe?g";

        // don't add duplicates!
        if (!in_array($extension, $this->extensions)) {
            $this->extensions[] = $extension;
        }
    }

    /**
     * Generates output for the specified image and send it to the browser
     * based on the provided configuration.
     *
     * @param string $alias
     * @param string $filename
     * @return Response
     * @throws Exception
     */
    public function process($alias, $filename) {
        // Ensure that at least some configuration has been provided.
        if (empty($this->config)) {
            throw new Exception("Cannot process without configuration.");
        }

        // Filter input.
        $alias = self::normAlias($alias);
        $file = preg_replace("#[^-_.a-z0-9]#i", "", $filename);

        // Generate regular expression based on provided file extension array.
        $fileMaskRegex = "#^.*\\.(" . join("|", $this->extensions) . ")\$#i";

        // Validate file extensions, valid configuration, and source file's existence.
        if (!preg_match($fileMaskRegex, $filename) || !isset($this->config[$alias]) || !is_file($filename)) {
            return Response::createGeneric404();
        }

        // Build paths.
        $origFile = "{$this->dir}/{$filename}";
        $cachePath = "{$this->dir}/{$alias}";
        $cacheFile = "{$cachePath}/{$filename}";

        // Prevent issues with blocking session when processing some of the long operations below.
        session_write_close();

        $build_image = false;

        /* @var $config AutoThumbConfig */
        $config = $this->config[$alias];

        // Setup cache directory if not done already.
        if (!is_dir($cachePath)) {
            mkdir($cachePath);
            $build_image = true;
        } elseif (!is_file($cacheFile)) {
            $build_image = true;
        } elseif (filemtime($cacheFile) < filemtime($origFile)) {
            $build_image = true;
        } elseif ($this->refresh) {
            $build_image = true;
        }

        if ($build_image === true) {
            $this->buildImage($config, $origFile, $cacheFile);
        }

        return new CachedImage($file, $cachePath);
    }

    /**
     * @param AutoThumbConfig $config
     * @param string $original
     * @param string $newFile
     * @throws Exception
     */
    private function buildImage($config, $original, $newFile) {
        $image = new Image($original);
        $fileParts = explode(".", $original);
        $extension = end($fileParts);
        switch ($config->cropType) {
            case AutoThumbConfig::CROP_EXACT:
                $image->cutOutBox($config->width, $config->height);
                break;
            case AutoThumbConfig::CROP_MAX:
                $image->shrinkAndSnip($config->width, $config->height);
                break;
            case AutoThumbConfig::CROP_MIN:
                $image->fitIntoBox($config->width, $config->height);
                break;
            case AutoThumbConfig::CROP_FILL:
                $image->letterbox($config->width, $config->height, $extension == 'png' ? '#7F000000' : '#FFFFFF');
                break;
            case AutoThumbConfig::CROP_STRETCH:
                $image->resize($config->width, $config->height);
                break;
            default:
                throw new Exception("Invalid crop type specified.");
                break;
        }

        if ($config->greyScale) {
            $image->desaturate();
        }

        $image->save($newFile, $config->quality);
    }

    /**
     * Normalizes configuration aliases for comparison and validation.
     *
     * @param	string	$alias
     * @return	string
     */
    public static function normAlias($alias) {
        return preg_replace("#[^-a-z0-9]#", "", strtolower($alias));
    }

    /**
     * Filters provided alias while also checking for duplicate setup.
     *
     * @param $alias
     * @return string
     * @throws Exception
     */
    public function checkAlias($alias) {
        $alias = self::normAlias($alias);
        if (isset($this->config[$alias])) {
            throw new Exception("Duplicate configuration: {$alias}");
        }

        return $alias;
    }

    /**
     * Indicate that we want to do a cache refresh
     *
     * @param bool $value
     */
    public function forceRefresh($value = true) {
        $this->refresh = $value;
    }
}
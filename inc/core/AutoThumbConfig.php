<?php
class AutoThumbConfig {

    /**
     * The desired width of the image.
     *
     * @var int
     */
    public $width = 0;

    /**
     * The desired height of the image.
     *
     * @var int
     */
    public $height = 0;

    /**
     * Write a comment lol
     *
     * @var int
     */
    public $cropType = 0;

    /**
     * Write a comment lol
     *
     * @var bool
     */
    public $scaleUp = true;

    /**
     * Write a comment lol
     *
     * @var int
     */
    public $compression = 90;

    /**
     * Write a comment lol
     *
     * @var int
     */
    public $quality = 90;


    /**
     * Write a comment lol
     *
     * @var string
     */
    public $waterMark = "";

    /**
     * Indicates to apply additional filter to produce a greyscale image.
     *
     * @var bool
     */
    public $greyScale = false;


    /** Will crop image to specified width/height aspect ratio (default). */
    const CROP_EXACT = 0;

    /** Will NOT crop and force image MAXIMUM dimensions to specified width/height. */
    const CROP_MAX = 1;

    /** Will NOT crop and force image MINIMUM dimensions to specified width/height. */
    const CROP_MIN = 2;

    /** Will NOT crop and apply padding to fill the specified width/height with white space. */
    const CROP_FILL = 3;

    /** Will NOT crop and stretches the image to fit the exact width/height specified. */
    const CROP_STRETCH = 4;


    /**
     * @param int $width
     * @param int $height
     * @param int $cropType
     * @param bool $scaleUp
     */
    public function __construct($width, $height, $cropType = null, $scaleUp = null) {
        $this->width = $width;
        $this->height = $height;

        if ($cropType !== null)
            $this->croptype = $cropType;

        if ($scaleUp !== null)
            $this->scaleup = $scaleUp;
    }

    /**
     * @param $cropType
     * @return $this
     */
    public function cropType($cropType) {
        $this->cropType = $cropType;
        return $this;
    }

    /**
     * @param bool $scaleUp
     * @return $this
     */
    public function scaleUp($scaleUp) {
        $this->scaleUp = $scaleUp;
        return $this;
    }

    /**
     * @param bool $preventEnlarge
     * @return $this
     */
    public function preventEnlarge($preventEnlarge) {
        $this->scaleUp(!$preventEnlarge);
        return $this;
    }

    /**
     * @param int $compression
     * @return $this
     */
    public function compression($compression) {
        $this->compression = $compression;
        return $this;
    }

    /**
     * @param int $quality
     * @return $this
     */
    public function quality($quality) {
        $this->quality = $quality;
        return $this;
    }

    /**
     * @param string $waterMark
     * @return $this
     */
    public function waterMark($waterMark) {
        $this->waterMark = $waterMark;
        return $this;
    }

    /**
     * @param bool $greyScale
     * @return $this
     */
    public function greyScale($greyScale) {
        $this->greyScale = (bool)$greyScale;
        return $this;
    }
}
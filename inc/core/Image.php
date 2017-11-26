<?php
class Image {

    /**
     * @var int Default output image quality
     */
    public $quality = 90;

    /**
     * @var resource
     */
    protected $image;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var array
     */
    protected $originalInfo;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var string
     */
    protected $imageString;

    /**
     * Image orientation constants
     */
    const PORTRAIT = 'portrait';
    const LANDSCAPE = 'landscape';
    const SQUARE = 'square';

    /**
     * Supported MIME types
     */
    const MIME_JPEG = 'image/jpeg';
    const MIME_PNG = 'image/png';
    const MIME_GIF = 'image/gif';

    /**
     * Create instance and load an image, or create an image from scratch.
     *
     * @param null|string   $fileName   Path to image file (may be omitted to create image from scratch)
     * @param int           $width      Image width (is used for creating image from scratch)
     * @param int|null      $height     If omitted - assumed equal to $width (is used for creating image from scratch)
     * @param null|string   $color      Hex color string, array(red, green, blue) or array(red, green, blue, alpha).
     *                                  Where red, green, blue - integers 0-255, alpha - integer 0-127
     *                                  (is used for creating image from scratch)
     * @return Image
     * @throws Exception
     */
    public function __construct($fileName = null, $width = null, $height = null, $color = null) {
        if ($fileName) {
            $this->load($fileName);
        } elseif ($width) {
            $this->create($width, $height, $color);
        }
        return $this;
    }

    /**
     * Destroy image resource.
     */
    public function __destruct() {
        if (get_resource_type($this->image) === 'gd') {
            imagedestroy($this->image);
        }
    }

    /**
     * Create an image from scratch.
     *
     * @param int           $width  Image width
     * @param int|null      $height If omitted - assumed equal to $width
     * @param null|string   $color  Hex color string, array(red, green, blue) or array(red, green, blue, alpha).
     *                              Where red, green, blue - integers 0-255, alpha - integer 0-127
     * @return $this
     */
    public function create($width, $height = null, $color = null) {
        $height = $height ?: $width;
        $this->width = $width;
        $this->height = $height;
        $this->image = imagecreatetruecolor($width, $height);
        $this->originalInfo = array(
            'width' => $width,
            'height' => $height,
            'orientation' => $this->getOrientation(),
            'exif' => null,
            'format' => 'png',
            'mime' => self::MIME_PNG
        );

        if ($color) {
            $this->fill($color);
        }

        return $this;
    }

    /**
     * Load an image.
     *
     * @param string $fileName path to image file
     * @return $this
     * @throws Exception
     */
    public function load($fileName) {
        // Require GD library
        if (!extension_loaded('gd')) {
            throw new Exception('Required extension GD is not loaded.');
        }

        $this->fileName = $fileName;
        return $this->getMetaData();
    }

    /**
     * Save an image. The resulting format will be determined by the file extension.
     *
     * @param null|string   $fileName   If omitted - original file will be overwritten
     * @param null|int      $quality    Output image quality in percents 0-100
     * @param null|string   $format     The format to use; determined by file extension if null
     * @return $this
     * @throws Exception
     */
    public function save($fileName = null, $quality = null, $format = null) {
        // Determine quality, filename, and format
        $quality = $quality ?: $this->quality;
        $fileName = $fileName ?: $this->fileName;

        if (!$format) {
            $format = $this->fileExtension($fileName) ?: $this->originalInfo['format'];
        }

        // Create the image
        switch (strtolower($format)) {
            case 'gif':
                $result = imagegif($this->image, $fileName);
                break;
            case 'jpg':
            case 'jpeg':
                imageinterlace($this->image, true);
                $result = imagejpeg($this->image, $fileName, round($quality));
                break;
            case 'png':
                $result = imagepng($this->image, $fileName, round(9 * $quality / 100));
                break;
            default:
                throw new Exception('Unsupported format: '.$format);
        }

        if (!$result) {
            throw new Exception('Unable to save image: ' . $fileName);
        }

        return $this;
    }


    /*****************************
     * Image information methods *
     *****************************/

    /**
     * Get meta data of image.
     * @return $this
     * @throws Exception
     */
    protected function getMetaData() {
        // gather meta data
        if (empty($this->imageString)) {
            $info = getimagesize($this->fileName);
            switch ($info['mime']) {
                case self::MIME_GIF:
                    $this->image = imagecreatefromgif($this->fileName);
                    break;
                case self::MIME_JPEG:
                    $this->image = imagecreatefromjpeg($this->fileName);
                    break;
                case self::MIME_PNG:
                    $this->image = imagecreatefrompng($this->fileName);
                    break;
                default:
                    throw new Exception('Invalid image: ' . $this->fileName);
                    break;
            }
        } elseif (function_exists('getimagesizefromstring')) {
            $info = getimagesizefromstring($this->imageString);
        } else {
            throw new Exception('Unknown method getimagesizefromstring');
        }

        $exif = null;
        //if (function_exists('exif_read_data') && $info['mime'] === self::MIME_JPEG && $this->imageString === null) {
          //  $exif = exif_read_data($this->fileName);
        //}

        $this->originalInfo = array(
            'width' => $info[0],
            'height' => $info[1],
            'orientation' => $this->getOrientation(),
            'exif' => $exif,
            'format' => $this->formatFromMimeType($info['mime']),
            'mime' => $info['mime']
        );

        $this->width = $info[0];
        $this->height = $info[1];

        imagesavealpha($this->image, true);
        imagealphablending($this->image, true);

        return $this;
    }

    /**
     * Get the current orientation
     * @return string   portrait|landscape|square
     */
    public function getOrientation() {
        if (imagesx($this->image) > imagesy($this->image)) {
            return self::LANDSCAPE;
        }

        if (imagesx($this->image) < imagesy($this->image)) {
            return self::PORTRAIT;
        }

        return self::SQUARE;
    }


    /************************
     * Image sizing methods *
     ************************/

    /**
     * Crop an image
     *
     * @param int $x1 Left
     * @param int $y1 Top
     * @param int $x2 Right
     * @param int $y2 Bottom
     * @return $this
     */
    public function crop($x1, $y1, $x2, $y2) {
        // Determine crop size
        if ($x2 < $x1) {
            list($x1, $x2) = array($x2, $x1);
        }

        if ($y2 < $y1) {
            list($y1, $y2) = array($y2, $y1);
        }

        $crop_width = $x2 - $x1;
        $crop_height = $y2 - $y1;

        // Perform crop
        $new = imagecreatetruecolor($crop_width, $crop_height);
        imagealphablending($new, false);
        imagesavealpha($new, true);
        imagecopyresampled($new, $this->image, 0, 0, $x1, $y1, $crop_width, $crop_height, $crop_width, $crop_height);

        // Update meta data
        $this->width = $crop_width;
        $this->height = $crop_height;
        $this->image = $new;

        return $this;
    }

    /**
     * Resize an image to the specified dimensions.
     *
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function resize($width, $height) {
        // Generate new GD image
        $new = imagecreatetruecolor($width, $height);

        if ($this->originalInfo['format'] === 'gif') {
            // Preserve transparency in GIFs
            $transparent_index = imagecolortransparent($this->image);
            $pallet_size = imagecolorstotal($this->image);
            if ($transparent_index >= 0 && $transparent_index < $pallet_size) {
                $transparent_color = imagecolorsforindex(
                    $this->image,
                    $transparent_index
                );

                $transparent_index = imagecolorallocate($new,
                    $transparent_color['red'],
                    $transparent_color['green'],
                    $transparent_color['blue']
                );

                imagefill($new, 0, 0, $transparent_index);
                imagecolortransparent($new, $transparent_index);
            }
        } else {
            // Preserve transparency in PNGs (benign for JPEGs)
            imagealphablending($new, false);
            imagesavealpha($new, true);
        }

        // Resize
        imagecopyresampled($new, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);

        // Update meta data
        $this->width = $width;
        $this->height = $height;
        $this->image = $new;

        return $this;
    }

    /**
     * This function crops a specified square out of the of the image, from the center.
     *
     * @param int       $width
     * @param int|null  $height If omitted - assumed equal to $width
     * @return $this
     */
    public function cutOutBox($width, $height = null) {
        // Determine height
        $height = $height ?: $width;

        $left = floor(($this->width / 2) - ($width / 2));
        $top = floor(($this->height / 2) - ($height / 2));

        // Return trimmed image
        return $this->crop($left, $top, $width + $left, $height + $top);
    }

    /**
     * Shrink the image proportionally to fit inside a $width x $height box.
     *
     * @param int $max_width
     * @param int $max_height
     * @return $this
     */
    public function fitIntoBox($max_width, $max_height) {
        // If it already fits, there's nothing to do
        if ($this->width <= $max_width && $this->height <= $max_height) {
            return $this;
        }

        // Determine aspect ratio
        $aspect_ratio = $this->height / $this->width;

        // Make width fit into new dimensions
        if ($this->width > $max_width) {
            $width = $max_width;
            $height = $width * $aspect_ratio;
        } else {
            $width = $this->width;
            $height = $this->height;
        }

        // Make height fit into new dimensions
        if ($height > $max_height) {
            $height = $max_height;
            $width = $height / $aspect_ratio;
        }

        return $this->resize($width, $height);
    }

    /**
     * Adds an image to the right of this image.
     * @param string $rightImagePath
     * @param int $xPos
     * @param int $height
     * @return $this
     */
    public function combineHorizontallyWith($rightImagePath, $xPos = 640, $height = 480){
        $extendedCanvas = imagecreatetruecolor($xPos * 2, $height);
        imagecopyresampled($extendedCanvas, $this->image, 0, 0, 0, 0, $xPos, $height, $xPos, $height);
        $rightImage = imagecreatefromjpeg($rightImagePath);
        imagecopymerge(
            $extendedCanvas,   // destination image
            $rightImage,    // source image
            $xPos,              // destination x
            0,              // destination y
            0,
            0,
            $xPos,
            $height,
            100);
        $this->image = $extendedCanvas;
        return $this;
    }

    /**
     * Takes the image and try to fit it into the space provided. If it's not a clean fit,
     * letterbox the remaining area with the specified background color.
     *
     * @param int $max_width
     * @param int $max_height
     * @param string $bg_color
     * @return $this
     */
    public function letterbox($max_width, $max_height, $bg_color = '#000000') {
        $current_width = imagesx($this->image);
        $current_height = imagesy($this->image);
        $current_ratio = $current_width / $current_height;

        $new_ratio = $max_width / $max_height;

        if ($current_ratio < $new_ratio) {
            // source has a taller ratio
            $width = (int)($max_height * $current_ratio);
            $height = $max_height;
            $x = (int)(($max_width - $width) / 2);
            $y = 0;
        } else {
            // source has a wider ratio
            $width = $max_width;
            $height = (int)($max_width / $current_ratio);
            $x = 0;
            $y = (int)(($max_height - $height) / 2);
        }

        $new = imagecreatetruecolor($max_width, $max_height);
        $rgba = $this->normalizeColor($bg_color);
        $fill_color = imagecolorallocatealpha($new, $rgba['r'], $rgba['g'], $rgba['b'], $rgba['a']);
        imagefill($new, 0, 0, $fill_color);
        imagecopyresampled($new, $this->image, $x, $y, 0, 0, $width, $height, $current_width, $current_height);
        imagesavealpha($new, TRUE);

        // Update meta data
        $this->width = $max_width;
        $this->height = $max_height;
        $this->image = $new;

        return $this;
    }

    /**
     * This function attempts to get the image to as close to the provided
     * dimensions as possible, and then crops the remaining overflow (from
     * the center) to get the image to be the size specified.
     *
     * @param int       $width
     * @param int|null  $height If omitted - assumed equal to $width
     * @return $this
     */
    public function shrinkAndSnip($width, $height = null) {
        // Determine height
        $height = $height ?: $width;

        // Determine aspect ratios
        $current_aspect_ratio = $this->height / $this->width;
        $new_aspect_ratio = $height / $width;

        // Fit to height/width
        if ($new_aspect_ratio > $current_aspect_ratio) {
            $this->fitToHeight($height);
        } else {
            $this->fitToWidth($width);
        }

        $left = floor(($this->width / 2) - ($width / 2));
        $top = floor(($this->height / 2) - ($height / 2));

        // Return trimmed image
        return $this->crop($left, $top, $width + $left, $height + $top);
    }

    /**
     * Fit to height (proportionally resize to specified height)
     * @param int $height
     * @return $this
     */
    public function fitToHeight($height) {
        $aspect_ratio = $this->height / $this->width;
        $width = $height / $aspect_ratio;
        return $this->resize($width, $height);
    }

    /**
     * Fit to width (proportionally resize to specified width)
     * @param int $width
     * @return $this
     */
    public function fitToWidth($width) {
        $aspect_ratio = $this->height / $this->width;
        $height = $width * $aspect_ratio;
        return $this->resize($width, $height);
    }


    /*****************************
     * Image orientation methods *
     *****************************/

    /**
     * Rotate an image
     *
     * @param int       $angle      0-360
     * @param string    $bg_color   Hex color string, array(red, green, blue) or array(red, green, blue, alpha).
     *                              Where red, green, blue - integers 0-255, alpha - integer 0-127
     * @return $this
     */
    public function rotate($angle, $bg_color = '#000000') {
        // Perform the rotation
        $rgba = $this->normalizeColor($bg_color);
        $bg_color = imagecolorallocatealpha($this->image, $rgba['r'], $rgba['g'], $rgba['b'], $rgba['a']);
        $new = imagerotate($this->image, -(Util::clamp($angle, -360, 360)), $bg_color);
        imagesavealpha($new, true);
        imagealphablending($new, true);

        // Update meta data
        $this->width = imagesx($new);
        $this->height = imagesy($new);
        $this->image = $new;

        return $this;
    }

    /**
     * Flip an image horizontally
     * @return $this
     */
    public function flipX() {
        $new = imagecreatetruecolor($this->width, $this->height);
        imagealphablending($new, false);
        imagesavealpha($new, true);

        for ($x = 0; $x < $this->width; $x++) {
            imagecopy($new, $this->image, $x, 0, $this->width - $x - 1, 0, 1, $this->height);
        }

        $this->image = $new;
        return $this;
    }

    /**
     * Flip an image horizontally or vertically
     * @return $this
     */
    public function flipY() {
        $new = imagecreatetruecolor($this->width, $this->height);
        imagealphablending($new, false);
        imagesavealpha($new, true);

        for ($y = 0; $y < $this->height; $y++) {
            imagecopy($new, $this->image, 0, $y, 0, $this->height - $y - 1, $this->width, 1);
        }

        $this->image = $new;
        return $this;
    }

    /**
     * Rotates and/or flips an image automatically so the orientation will be correct (based on exif 'Orientation')
     * @return $this
     */
    public function orient() {
        if (isset($this->originalInfo['exif']['Orientation'])) {
            switch ($this->originalInfo['exif']['Orientation']) {
                case 1: // Do nothing
                    break;
                case 2: // Flip horizontal
                    $this->flipX();
                    break;
                case 3: // Rotate 180 counter-clockwise
                    $this->rotate(-180);
                    break;
                case 4: // vertical flip
                    $this->flipY();
                    break;
                case 5: // Rotate 90 clockwise and flip vertically
                    $this->flipY();
                    $this->rotate(90);
                    break;
                case 6: // Rotate 90 clockwise
                    $this->rotate(90);
                    break;
                case 7: // Rotate 90 clockwise and flip horizontally
                    $this->flipX();
                    $this->rotate(90);
                    break;
                case 8: // Rotate 90 counter-clockwise
                    $this->rotate(-90);
                    break;
            }
        }

        return $this;
    }


    /********************************
     * Image effect transformations *
     ********************************/

    /**
     * Fill image with color
     *
     * @param string        $color  Hex color string, array(red, green, blue) or array(red, green, blue, alpha).
     *                              Where red, green, blue - integers 0-255, alpha - integer 0-127
     * @return $this
     */
    public function fill($color = '#000000') {
        $rgba = $this->normalizeColor($color);
        $fill_color = imagecolorallocatealpha($this->image, $rgba['r'], $rgba['g'], $rgba['b'], $rgba['a']);
        imagealphablending($this->image, false);
        imagesavealpha($this->image, true);
        imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $fill_color);
        return $this;
    }

    /**
     * Changes the opacity level of the image
     *
     * @param float|int $opacity normal value (between 0 and 1)
     * @return $this
     * @throws Exception
     */
    public function opacity($opacity) {
        // Determine opacity
        $opacity = Util::clamp($opacity, 0, 1) * 100;

        // Make a copy of the image
        $copy = imagecreatetruecolor($this->width, $this->height);
        imagealphablending($copy, false);
        imagesavealpha($copy, true);
        imagecopy($copy, $this->image, 0, 0, 0, 0, $this->width, $this->height);

        // Create transparent layer
        $this->create($this->width, $this->height, array(0, 0, 0, 127));

        // Merge with specified opacity
        $this->imagecopymerge_alpha($this->image, $copy, 0, 0, 0, 0, $this->width, $this->height, $opacity);
        imagedestroy($copy);

        return $this;
    }

    /**
     * Desaturate
     * @param int $percentage
     * @return $this
     */
    public function desaturate($percentage = 100) {
        $percentage = Util::clamp($percentage, 0, 100);

        if ($percentage === 100) {
            imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        } else {
            $new = imagecreatetruecolor($this->width, $this->height);
            imagealphablending($new, false);
            imagesavealpha($new, true);
            imagecopy($new, $this->image, 0, 0, 0, 0, $this->width, $this->height);
            imagefilter($new, IMG_FILTER_GRAYSCALE);

            $this->imagecopymerge_alpha($this->image, $new, 0, 0, 0, 0, $this->width, $this->height, $percentage);
            imagedestroy($new);
        }

        return $this;
    }


    /**********************
     * Internal utilities *
     **********************/

    /**
     * Returns the file extension of the specified file.
     *
     * @param string $fileName
     * @return string
     */
    protected function fileExtension($fileName) {
        if (!preg_match('/\./', $fileName)) {
            return '';
        }

        return preg_replace('/^.*\./', '', $fileName);
    }

    /**
     * Returns the file extension from the mime type.
     *
     * @param string $mime_type
     * @return string
     */
    protected function formatFromMimeType($mime_type) {
        return preg_replace('/^image\//', '', $mime_type);
    }

    /**
     * Same as PHP's imagecopymerge() function, except preserves alpha-transparency in 24-bit PNGs
     *
     * @param $dst_im
     * @param $src_im
     * @param $dst_x
     * @param $dst_y
     * @param $src_x
     * @param $src_y
     * @param $src_w
     * @param $src_h
     * @param $pct
     *
     * @link http://www.php.net/manual/en/function.imagecopymerge.php#88456
     */
    protected function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {
        // Get image width and height and percentage
        $pct /= 100;
        $w = imagesx($src_im);
        $h = imagesy($src_im);

        // Turn alpha blending off
        imagealphablending($src_im, false);

        // Find the most opaque pixel in the image (the one with the smallest alpha value)
        $minalpha = 127;
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $alpha = (imagecolorat($src_im, $x, $y) >> 24) & 0xFF;
                if ($alpha < $minalpha) {
                    $minalpha = $alpha;
                }
            }
        }

        // Loop through image pixels and modify alpha for each
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {

                // Get current alpha value (represents the TRANSPARENCY!)
                $colorxy = imagecolorat($src_im, $x, $y);
                $alpha = ($colorxy >> 24) & 0xFF;

                // Calculate new alpha
                if ($minalpha !== 127) {
                    $alpha = 127 + 127 * $pct * ($alpha - 127) / (127 - $minalpha);
                } else {
                    $alpha += 127 * $pct;
                }

                // Get the color index with new alpha
                $alphacolorxy = imagecolorallocatealpha($src_im, ($colorxy >> 16) & 0xFF, ($colorxy >> 8) & 0xFF, $colorxy & 0xFF, $alpha);

                // Set pixel with the new color + opacity
                if (!imagesetpixel($src_im, $x, $y, $alphacolorxy)) {
                    return;
                }
            }
        }

        // Copy it
        imagesavealpha($dst_im, true);
        imagealphablending($dst_im, true);
        imagesavealpha($src_im, true);
        imagealphablending($src_im, true);
        imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);
    }

    /**
     * Converts a hex color value to its RGB equivalent
     *
     * @param string        $color  Hex color string, array(red, green, blue) or array(red, green, blue, alpha).
     *                              Where red, green, blue - integers 0-255, alpha - integer 0-127
     * @return array|null
     */
    protected function normalizeColor($color) {
        if (is_string($color)) {
            $color = trim($color, '#');
            if (strlen($color) === 6) {
                list($r, $g, $b) = array(
                    $color[0].$color[1],
                    $color[2].$color[3],
                    $color[4].$color[5]
                );
            } elseif (strlen($color) === 3) {
                list($r, $g, $b, $a) = array(
                    $color[0].$color[0],
                    $color[1].$color[1],
                    $color[2].$color[2]
                );
            } elseif(strlen($color) === 8){
                list($a, $r, $g, $b) = array(
                    $color[0].$color[1],
                    $color[2].$color[3],
                    $color[4].$color[5],
                    $color[6].$color[7]
                );
            } else {
                return false;
            }

            return array(
                'r' => hexdec($r),
                'g' => hexdec($g),
                'b' => hexdec($b),
                'a' => isset($a) ? hexdec($a) : 0
            );

        } elseif (is_array($color) && (count($color) === 3 || count($color) === 4)) {
            if (isset($color['r'], $color['g'], $color['b'])) {
                return array(
                    'r' => Util::clamp($color['r'], 0, 255),
                    'g' => Util::clamp($color['g'], 0, 255),
                    'b' => Util::clamp($color['b'], 0, 255),
                    'a' => Util::clamp(isset($color['a']) ? $color['a'] : 0, 0, 127)
                );
            } elseif (isset($color[0], $color[1], $color[2])) {
                return array(
                    'r' => Util::clamp($color[0], 0, 255),
                    'g' => Util::clamp($color[1], 0, 255),
                    'b' => Util::clamp($color[2], 0, 255),
                    'a' => Util::clamp(isset($color[3]) ? $color[3] : 0, 0, 127)
                );
            }
        }

        return null;
    }
}
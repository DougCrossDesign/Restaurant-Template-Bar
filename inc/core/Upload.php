<?php
abstract class Upload {

    /**
     * @var string
     */
    protected $path;

    /**
     * @var bool
     */
    protected $overWrite;

    /**
     * @var int
     */
    protected $maxSize;

    /**
     * @var int
     */
    protected $lastError;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var array
     */
    protected $currentFile;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @param string $path
     * @param array $settings
     */
    public function __construct($path, $settings = []) {
        $this->path = $path;

        $this->overWrite = isset($settings['overWrite']) ? $settings['overWrite'] : false;

        $maxSize = ini_get('upload_max_filesize');
        if (isset($settings['maxSize']) && is_int($settings['maxSize'])) {
            $this->maxSize = $settings['maxSize'] <= $maxSize ? $settings['maxSize'] : $maxSize;
        } else {
            $this->maxSize = $maxSize;
        }

        $this->lastError = UPLOAD_ERR_OK;
        $this->errorMessage = '';

        $this->currentFile = [
            'name' => null,
            'type' => null,
            'tmp_name' => null,
            'size' => null,
            'error' => null,
        ];
    }

    /**
     * @param array $file
     * @return bool
     */
    public function process($file) {
        $this->currentFile = $file;
        if ($this->validate()) {
            $file_destination = rtrim($this->path, '/') . '/';

            // give leaf classes the chance to manipulate the file's name any way they see fit
            $extensionParts = explode("/", $file['type']);
            $extension = end($extensionParts);
            $this->fileName = $this->generateFileName($extension);
            $file_destination .= $this->fileName;

            if (!move_uploaded_file($this->currentFile['tmp_name'], $file_destination)) {
                $this->errorMessage = "Unable to process uploaded file: " . $this->currentFile['name'];
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getCurrentName() {
        if ($this->fileName === null)
            $this->fileName = $this->currentFile['name'];
        return $this->fileName;
    }

    /**
     * @return string
     */
    protected abstract function generateFileName();

    /**
     * @return string
     */
    public function getLastError() {
        return $this->errorMessage;
    }

    /**
     * @return bool
     */
    protected function validate() {

        // ensure we got all the required information from our caller
        if (!isset($this->currentFile['name']) ||
            !isset($this->currentFile['type']) ||
            !isset($this->currentFile['tmp_name']) ||
            !isset($this->currentFile['size']) ||
            !isset($this->currentFile['error'])) {
            $this->errorMessage = "Invalid file settings.";
            return false;
        }

        $this->lastError = $this->currentFile['error'];

        // if web server encountered an error, pass it along
        if ($this->lastError !== UPLOAD_ERR_OK) {
            switch ($this->lastError) {
                case UPLOAD_ERR_INI_SIZE:
                    $this->errorMessage = "The uploaded file exceeds the maximum size allowed for file uploads.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $this->errorMessage = "The uploaded file exceeds the maximum size allowed for file uploads.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $this->errorMessage = "The uploaded file was only partially uploaded.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $this->errorMessage = "No file was uploaded.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $this->errorMessage = "Missing a temporary folder.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $this->errorMessage = "Failed to write file to disk.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $this->errorMessage = "File upload stopped by extension.";
                    break;
            }
            return false;
        }

        return true;
    }
}
<?php
class ImageUpload extends Upload {

    /**
     * The character set in which we use to generate a random file name.
     */
    const CHARS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    /**
     * The length of the file name that is generated.
     */
    const LENGTH = 5;

    static $ALLOWED_EXTENSIONS = [
        "image/jpg",
        "image/jpeg",
        "image/pjpeg",
        "image/png",
        "image/gif"
    ];

    /**
     * @param string $path
     * @param array $settings
     */
    public function __construct($path, $settings = []) {
        parent::__construct($path, $settings);
    }

    /**
     * @return string
     */
    public function generateFileName($extension = 'jpg') {
        if ($this->fileName === null)
            $this->fileName = $this->getRandomName($extension);
        return $this->fileName;
    }

    /**
     * @param string $extension
     * @return string
     */
    private function getRandomName($extension = 'jpg') {
        $dir = trim($this->path, '/');
        do {
            $code = $this->randomCode();
            $exists = file_exists(SYSTEM_DIR . "/{$dir}/{$code}.{$extension}");
        } while ($exists);

        return "{$code}.{$extension}";
    }

    /**
     * @return string
     */
    private function randomCode(){
        $generated_code = "";
        for ($i = self::LENGTH; $i--; ) {
            $generated_code .= substr(self::CHARS, (mt_rand() % (strlen(self::CHARS))), 1);
        }

        return $generated_code;
    }

    public function validate(){
        // check that this mime type is accepted
        if(!in_array($this->currentFile['type'], static::$ALLOWED_EXTENSIONS)){
            $this->errorMessage = "This filetype is not accepted. Please upload a file of types " . implode(", ", static::$ALLOWED_EXTENSIONS) . ".";
            return false;
        }

        return parent::validate();
    }
}
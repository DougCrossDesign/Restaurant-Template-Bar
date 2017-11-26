<?php
class FileUpload extends Upload {

    /**
     * @return string
     */
    public function generateFileName() {
        list($dirName, $baseName, $extension, $fileName) = array_values(pathinfo($this->currentFile['name']));
        $dirName = trim($this->path, '/');

        if (!file_exists("/{$dirName}/{$fileName}.{$extension}")) {
            return "{$fileName}.{$extension}";
        }

        $similarCount = 0;

        /** @var SplFileInfo $fileInfo */
        foreach (new FilesystemIterator("/{$dirName}", FilesystemIterator::SKIP_DOTS) as $fileInfo) {
            if (strpos($fileInfo->getFilename(), $fileName, 0) !== false) {
                $similarCount++;
            }
        }

        $newName = $fileName . '-' . ($similarCount+1);
        return "{$newName}.{$extension}";
    }
}
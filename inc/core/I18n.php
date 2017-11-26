<?php
class I18n {

    /**
     * Convert a string to UTF-8, remove invalid bytes sequences, and control
     * characters.
     *
     * @param string|array $data to convert
     * @param bool $control true to remove control characters
     * @param string $encoding current encoding of string (default to UTF-8)
     * @return string
     */
    public static function filter($data, $control = true, $encoding = null) {
        if (is_array($data) === true) {

            $result = array();
            foreach ($data as $key => $value) {
                $result[self::filter($key, $control, $encoding)] = self::filter($value, $control, $encoding);
            }
            return $result;

        } else if (is_string($data) === true) {

            if (preg_match('~[^\x00-\x7F]~', $data) > 0) {
                if (function_exists('mb_detect_encoding') === true) {
                    $encoding = mb_detect_encoding($data, 'auto');
                }

                $data = @iconv((empty($encoding) === true) ? 'UTF-8' : $encoding, 'UTF-8//IGNORE', $data);
            }

            return ($control === true) ?
                preg_replace('~\p{C}+~u', '', $data) :
                preg_replace(array('~\r\n?~', '~[^\P{C}\t\n]+~u'), array("\n", ''), $data);
        }

        return $data;
    }
}

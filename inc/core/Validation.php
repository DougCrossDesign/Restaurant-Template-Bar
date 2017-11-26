<?php

/**
 * Class Validation
 * @method plaintext Not sure
 */
class Validation {
    // Current field
    public $field;

    // Data to validate
    public $data;

    // Array of errors
    public $errors;

    // The text to put before an error
    public $error_prefix = '<div class="validation_error">';

    // The text to put after an error
    public $error_suffix = '</div>';

    /**
     * Create the validation object using this data
     *
     * @param array $data to validate
     */
    public function __construct($data) {
        $this->data = $data;
        $this->errors = array();
    }


    /**
     * Add a new field to the validation object
     *
     * @param string $field name
     * @return Validation $this
     */
    public function field($field) {
        $this->field = $field;
        return $this;
    }


    /**
     * Return the value of the given field
     *
     * @param string $field name to use instead of current field
     * @return mixed
     */
    public function value($field = null) {
        if (!$field) {
            $field = $this->field;
        }

        if (isset($this->data[$field])) {
            return $this->data[$field];
        }
    }


    /**
     * Return success if validation passes!
     *
     * @return boolean
     */
    public function validates() {
        return !$this->errors;
    }


    /**
     * Fetch validation error for the given field
     *
     * @param string $field name to use instead of current field
     * @param boolean $wrap error with suffix/prefix
     * @return string
     */
    public function error($field = null, $wrap = false) {
        if (!$field) {
            $field = $this->field;
        }

        if (isset($this->errors[$field])) {
            if ($wrap) {
                return $this->error_prefix . $this->errors[$field] . $this->error_suffix;
            }

            return $this->errors[$field];
        }
    }


    /**
     * Manually add an error to the validator
     *
     * @param string $field name to use instead of current field
     * @param string $error description of error
     * @return string
     */
    public function add_error($field, $error) {
        $this->errors[$field] = $error;
    }


    /**
     * Return all validation errors as an array
     *
     * @return array
     */
    public function errors() {
        return $this->errors;
    }


    /**
     * Return all validation errors wrapped in HTML suffix/prefix
     *
     * @return string
     */
    public function __toString() {
        $output = '';

        foreach ($this->errors as $error) {
            $output .= $this->error_prefix . $error . $this->error_suffix . "\n";
        }

        return $output;
    }


    /**
     * Middle-man to all rule functions to set the correct error on failure.
     *
     * @param string $rule
     * @param array $args
     * @return Validation $this
     */
    public function __call($rule, $args) {
        if (isset($this->errors[$this->field]) || empty($this->data[$this->field]))
            return $this;

        // Add method suffix
        $method = $rule . '_rule';

        // Defaults for $error, $params
        $args = $args + array(null, null, null);

        // If the validation fails
        if (!$this->$method($this->data[$this->field], $args[1], $args[2])) {
            $this->errors[$this->field] = $args[0];
        }

        return $this;
    }


    /**
     * Value is required and cannot be empty.
     *
     * @param string $error message
     * @return Validation
     */
    public function required($error) {
        if (empty($this->data[$this->field])) {
            $this->errors[$this->field] = $error;
        }

        return $this;
    }


    /**
     * Verify value is a string.
     *
     * @param mixed $data to validate
     * @return boolean
     */
    protected function string_rule($data) {
        return is_string($data);
    }


    /**
     * Verify value is an array.
     *
     * @param mixed $data to validate
     * @return boolean
     */
    protected function array_rule($data) {
        return is_array($data);
    }


    /**
     * Verify value is a number
     *
     * @param mixed $data to validate
     * @return boolean
     */
    protected function number_rule($data) {
        return is_numeric($data);
    }


    /**
     * Verify value is an integer
     *
     * @param string $data to validate
     * @return boolean
     */
    protected function integer_rule($data) {
        return is_int($data) || ctype_digit($data);
    }


    /**
     * Verifies the given date string is a valid date using the format provided.
     *
     * @param string $data to validate
     * @param string $format of date string
     * @return boolean
     */
    protected function date_rule($data, $format = null) {
        if ($format !== null) {
            return \DateTime::createFromFormat($format, $data) !== false ? true : false;
        }

        return strtotime($data) !== false ? true : false;
    }


    /**
     * Condition must be true.
     *
     * @param mixed $data to validate
     * @param boolean $condition to test
     * @return boolean
     */
    protected function true_rule($data, $condition) {
        return $condition;
    }


    /**
     * Field must have a value matching one of the options
     *
     * @param mixed $data to validate
     * @param array $options array of possible values
     * @return boolean
     */
    protected function options_rule($data, $options) {
        return in_array($data, $options);
    }


    /**
     * Validate that the given value is a valid IP4/6 address.
     *
     * @param mixed $data to validate
     * @return boolean
     */
    protected function ip_rule($data) {
        return (filter_var($data, FILTER_VALIDATE_IP) !== false);
    }


    /**
     * Verify that the value of a field matches another one.
     *
     * @param mixed $data to validate
     * @param string $field name of the other element
     * @return boolean
     */
    protected function matches_rule($data, $field) {
        if (isset($this->data[$field])) {
            return $data === $this->data[$field];
        }
    }


    /**
     * Check to see if the email entered is valid.
     *
     * @param string $data to validate
     * @return boolean
     */
    protected function email_rule($data) {
        return (!filter_var($data, FILTER_VALIDATE_EMAIL) === false) ? true : false;
    }


    /**
     * Check to see if all the emails entered are valid.
     *
     * @param string $data to validate
     * @return boolean
     */
    protected function emails_rule($data) {
        $emails = explode(',', $data);

        $result = true;
        foreach ($emails as $email) {
            $email = trim($email);

            $result = (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) ? true : false;
            if (!$result)
                return false;
        }

        return $result;
    }


    /**
     * Check to see if the link entered is valid.
     *
     * @param string $data to validate
     * @return boolean
     */
    protected function link_rule($data) {
        return (!filter_var($data, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED) === false) ? true : false;
    }


    /**
     * Must only contain word characters (A-Za-z0-9_).
     *
     * @param string $data to validate
     * @return boolean
     */
    protected function word_rule($data) {
        return !preg_match("/\W/", $data);
    }


    /**
     * Must only contain letter and numeric characters.
     *
     * @param string $data to validate
     * @return boolean
     */
    protected function wordsnumbers_rule($data) {
        return ctype_alnum($data);
    }


    /**
     * Plain text that contains no HTML/XML "><" characters.
     *
     * @param string $data to validate
     * @return boolean
     */
    protected function plaintext_rule($data) {
        return (mb_strpos($data, '<') === false && mb_strpos($data, '>') === false);
    }


    /**
     * Minimum length of the string.
     *
     * @param string $data to validate
     * @param int $length of the string
     * @return boolean
     */
    protected function min_rule($data, $length) {
        return mb_strlen($data) >= $length;
    }


    /**
     * Maximum length of the string.
     *
     * @param string $data to validate
     * @param int $length of the string
     * @return boolean
     */
    protected function max_rule($data, $length) {
        return mb_strlen($data) <= $length;
    }


    /**
     * between length of the string.
     *
     * @param string $data to validate
     * @param int $min of the string
     * @param int $max of the string
     * @return boolean
     */
    protected function between_rule($data, $min, $max) {
        $strlen = mb_strlen($data);
        return ($max > $min) && ($strlen >= $min) && ($strlen <= $max);
    }


    /**
     * Value is in number range specified.
     *
     * @param mixed $data to validate
     * @param int $min of the string
     * @param int $max of the string
     * @return boolean
     */
    protected function range_rule($data, $min, $max) {
        return is_numeric($data) ? ($max > $min) && ($data >= $min) && ($data <= $max): false;
    }


    /**
     * Exact length of the string.
     *
     * @param string $data to validate
     * @param int $length of the string
     * @return boolean
     */
    protected function length_rule($data, $length) {
        return mb_strlen($data) === $length;
    }


    /**
     * Must be a valid hex color for css.
     *
     * @param string $data to validate
     * @return boolean
     */
    protected function hex_rule($data) {
        return preg_match('/^[a-f0-9]{6}$/i', $data);
    }
}
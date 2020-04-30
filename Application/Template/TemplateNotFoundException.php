<?php

namespace Template;

class TemplateNotFoundException extends \Exception {

    /**
     * TemplateNotFoundException constructor.
     *
     * @param $message
     */
    public function __construct($message) {
        parent::__construct($message);
    }
}
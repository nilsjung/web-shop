<?php

namespace View;

use Template\Template;

class IndexView extends View {

    public function __construct( $controller, $model ) {
        parent::__construct($controller, $model);
        $template = new Template();
        $this->setTemplate($template);
    }

    public function render() {
        $this->template->title = "Wilkommen in unserem Shop";
        return $this->template->render("Login.inc");
    }
}
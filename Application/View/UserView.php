<?php

namespace View;

use Template\Template;

class UserView extends View {

    public function __construct( $controller, $model ) {
        parent::__construct($controller, $model);
        $template = new Template();
        $this->setTemplate($template);
    }

    public function render() {
        $this->template->title = "User View";
        return $this->template->render("User.inc");
    }
}
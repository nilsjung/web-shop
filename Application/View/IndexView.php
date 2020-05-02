<?php

namespace View;

use Template\Template;

class IndexView extends View {

    public function render() {
        $this->template->sessionAttributes = $_SESSION;
        return $this->template->render("Login.inc");
    }
}
<?php

namespace View;

class IndexView extends View {

    public function render() {
        $this->template->sessionAttributes = $_SESSION;
        return $this->template->render("Login.inc");
    }
}
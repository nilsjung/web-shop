<?php

namespace View;

class NavigationView extends View {

    public function render() {
        if ($_SESSION && $_SESSION["isAuthenticated"]) {
            $this->template->isAuthenticated = true;
            $this->template->userId = $_SESSION['userId'];
        } else {
            $this->template->isAuthenticated = false;
        }

        return $this->template->render("Navigation.inc");

    }
}
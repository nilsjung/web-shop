<?php

namespace View;

class MainTemplateView extends View {

    public function render() {
        $navigation = new NavigationView(null, null);

        $this->template->isAuthenticated = $_SESSION["isAuthenticated"];
        $this->template->navigationView = $navigation->render();
        return $this->template->render("Main.inc");

    }
}
<?php

namespace View;

class ArticleView extends View {

    public function render() {
        $this->template->articles = $this->model->getAll();
        $this->template->title = "Articles";
        return $this->template->render("Articles.inc");
    }
}
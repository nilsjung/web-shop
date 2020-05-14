<?php

namespace View;

class ErrorView extends View
{
    public function render()
    {
        return $this->template->render('ErrorPage.inc');
    }
}

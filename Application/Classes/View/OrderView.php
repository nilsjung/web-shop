<?php

namespace View;

class OrderView extends View
{
    public function render()
    {
        return $this->template->render("Order.inc");
    }
}

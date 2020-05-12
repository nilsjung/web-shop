<?php

namespace View;

/**
 * Class ArticleView
 *
 * @package View
 */
class ShoppingCartView extends View
{
    /**
     * @return mixed
     */
    public function render()
    {
        return $this->template->render("ShoppingCart.inc");
    }
}

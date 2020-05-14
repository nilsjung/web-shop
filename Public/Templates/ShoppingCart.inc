<div class="shopping-cart container ">
    <h1 class="mt-5 mb-5">Your Shopping Cart</h1>
    <ul class="list-group">
        <?foreach($this->articles as $article) : ?>
            <li class="list-group-item"><?= $article->getName() ?> <div><?= $article->getInCart()?></div></li>
        <?endforeach;?>
    </ul>
</div>
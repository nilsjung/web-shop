<div class="shopping-cart container ">
    <h1 class="mt-5 mb-5">Your Shopping Cart</h1>
    <div class="row">
        <div class="col-6">
            <ul class="list-group">
                <? foreach ($this->articles as $article) : ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <?= $article->getName() ?>
                        <div><?= $article->getInCart() ?></div>
                        <div class="shopping-cart__action-buttons flex-column justify-content-between">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="/shopping-cart/remove/?article_id=<?=$article->getId(); ?>&token=<?= $this->token?>" type="button" class="btn btn-outline-primary">-</a>
                                <a href="/shopping-cart/add/?article_id=<?=$article->getId(); ?>&token=<?= $this->token?>" type="button" class="btn btn-outline-primary">+</a>
                            </div>
                            <a href="/shopping-cart/delete/?article_id=<?= $article->getId(); ?>&token=<?= $this->token?>" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                        </div>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
        <div class="col-6">
        <div id="checkout-container" data-is-authenticated="<?= $this->isAuthenticated?>" ></div>
        </div>
    </div>
</div>
<div class="shopping-cart container ">
    <h1 class="mt-5 mb-5">Your Shopping Cart</h1>
    <div class="row">
        <div class="col-6">
            <ul class="list-group-list list-group-flush">
                <? foreach ($this->articles as $article) : ?>
                    <li class="list-group-item container">
                        <div class="row">
                            <div class="col"><?= $article->getName() ?></div>
                            <div class="col"><?= $article->getInCart() ?></div>
                            <div class="col shopping-cart__action-buttons justify-content-end">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <a href="/shopping-cart/remove/?article_id=<?=$article->getId(); ?>&token=<?= $this->token?>" type="button" class="btn btn-outline-primary">-</a>
                                    <a href="/shopping-cart/add/?article_id=<?=$article->getId(); ?>&token=<?= $this->token?>" type="button" class="btn btn-outline-primary">+</a>
                                </div>
                                <a href="/shopping-cart/delete/?article_id=<?= $article->getId(); ?>&token=<?= $this->token?>" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </li>
                <? endforeach; ?>
                <li class="list-group-item">
                    Total: <?= $this->shoppingCartTotal ?>
                </li>
            </ul>
        </div>
    </div>
    <?php if (sizeof($this->articles) > 0): ?>
    <a href="/payment?step=<?=$this->paymentStep?>&token=<?=$this->token?>" type="button" class="mt-3 btn btn-outline-primary" >Buy</a>
    <?else:?>
    <div class="alert alert-light">
        No items in your shopping cart. Go shopping...
    </div>
    <?endif;?>
</div>

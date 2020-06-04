<h5 class="card-title">Check your order and buy your articles</h5>
<div class="row mt-4">
    <div class="col-6">
        <h6 class="">This is your current order</h6>
        <ul class="list-group">
            <? foreach ($this->articles as $article) : ?>
                <li class="list-group-item d-flex justify-content-between">
                    <?= $article->getName() ?>
                    <div><?= $article->getInCart() ?></div>
                    <div class="shopping-cart__action-buttons flex-column justify-content-between">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a href="/payment/shopping-cart/remove/?article_id=<?=$article->getId(); ?>&token=<?= $this->token?>" type="button" class="btn btn-outline-primary">-</a>
                            <a href="/payment/shopping-cart/add/?article_id=<?=$article->getId(); ?>&token=<?= $this->token?>" type="button" class="btn btn-outline-primary">+</a>
                        </div>
                        <a href="/payment/shopping-cart/delete/?article_id=<?= $article->getId(); ?>&token=<?= $this->token?>" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                    </div>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
    <div class="col-6">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal" <?= $this->paymentMethod === "paypal" ? "checked=true" : "" ?>">
            <label class="form-check-label" for="paypal">
                PayPal
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="credit-card" value="credit_card" "<?= $this->paymentMethod === "credit_cart" ? "checked=true" : "" ?>">
            <label class="form-check-label" for="credit-card">
                Credit Card
            </label>
        </div>
    </div>
</div>
<div class="text-center mt-5">
    <a href="/payment/order?token=<?=$this->token?>" class="btn btn-primary">Buy</a>
</div>

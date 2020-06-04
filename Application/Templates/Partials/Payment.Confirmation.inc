<h5 class="card-title">This is the last step. Please verify and buy</h5>
<form method="post" action="/order">
    <input type="hidden" name="order_hash" value="<?=$this->hash?>">
    <input type="hidden" name="token" value="<?=$this->token ?>">
    <input type="hidden" name="total" value="<?=$this->shoppingCart->getSum()?>" >
    <div class="form-row">
        <div class="col">
            <div class="form-group row">
                <label class="col-3 col-form-label" for="first-name">First Name</label>
                <div class="col">
                    <input type="text" id="first-name" disabled value="<?= $this->user->getFirstName() ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label" for="last-name">Last Name</label>
                <div class="col">
                    <input type="text" disabled id="last-name" value="<?= $this->user->getLastName() ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label" for="email-address">Email Address</label>
                <div class="col">
                    <input type="text" disabled id="email-address" value="<?= $this->user->getEmailAddress() ?>">
                </div>
            </div>
        </div>
        <div class="col list-group-list list-group-flush">
            <? foreach ($this->shoppingCart->getArticles() as $article) : ?>
                <li  class="list-group-item">
                    <?= $article->getInCart() ?> x <?= $article->getName() ?> <span>(<?php echo $article->getInCart() * $article->getPrice()?> €)</span>
                </li>
            <? endforeach; ?>
            <li class="list-group-item">
                <div class="sum font-weight-bold">Total: <?=$this->shoppingCart->getSum()?> Euro</div>
            </li>
        </div>
    </div>
        <div class="col d-flex justify-content-between">
            <a href="/payment?step=2&token=<?=$this->token?>" type="" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Buy</button>
        </div>
</form>

<h5 class="card-title">This is the last step. Please verify and buy</h5>
<form method="post" action="/payment/confirm">
    <input type="hidden" name="order_hash" value="<?=$this->orderHash?>">
    <input type="hidden" name="token" value="<?=$this->token ?>">
    <div class="form-row">
        <div class="col">
            <div class="form-group row">
                <label class="col-3 col-form-label" for="first-name">First Name</label>
                <div class="col">
                    <input type="text" name="first_name" id="first-name" disabled value="<?= $this->user->getFirstName() ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label" for="last-name">Last Name</label>
                <div class="col">
                    <input type="text" name="last_name" disabled id="last-name" value="<?= $this->user->getLastName() ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label" for="email-address">Email Address</label>
                <div class="col">
                    <input type="text" name="email_address" disabled id="email-address" value="<?= $this->user->getEmailAddress() ?>">
                </div>
            </div>
        </div>
        <div class="col list-group-list list-group-flush">
            <? foreach ($this->articles as $article) : ?>
                <li  class="list-group-item">
                    <?= $article->getInCart() ?> x <?= $article->getName() ?>
                </li>
            <? endforeach; ?>
        </div>
    </div>
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Buy</button>
        </div>
</form>

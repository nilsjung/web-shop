<h5 class="card-title">Select Payment Method</h5>
<div class="row mt-4">
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
    <div class="row">
        <div class="col mt-5 d-flex justify-content-between">
            <a href="/payment?step=1&token=<?=$this->token?>" class="btn btn-secondary">Back</a>
            <a href="/payment?step=3&token=<?=$this->token?>" class="btn btn-primary">Next</a>
        </div>
    </div>

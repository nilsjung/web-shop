<h5 class="card-title">Please log in to continue</h5>
<form method="post" action="/payment/login">
    <input type="hidden" name="token" value="<?=$this->token ?>"
    <input type="hidden" name="step" value="1">
    <div class="form-row">
        <div class="col form-group">
            <label for="email-address">Email address</label>
            <input type="email" name="email_address" class="form-control" id="email-address">
        </div>
        <div class="col form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" id="password">
        </div>
    </div>
    <div class="col text-center">
        <button type="submit" class="btn btn-primary">Next</button>
    </div>
</form>
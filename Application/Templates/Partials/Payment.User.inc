<h5 class="card-title">Please check your personal information, and continue...</h5>
<form method="post" action="/payment/user/update">
    <div class="form-row">
        <div class="form-group col-md-4">
            <input type="hidden" name="token" value="<?=$this->token ?>">
            <input type="hidden" name="step" value="2">
            <label for="first-name">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first-name" value="<?= $this->user->getFirstName() ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="last-name">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="last-name" value="<?= $this->user->getLastName() ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="email-address">Email Address</label>
            <input type="text" name="email_address" class="form-control" id="email-address" value="<?= $this->user->getEmailAddress() ?>">
        </div>
        <div class="col text-right">
            <button type="submit" class="btn btn-primary">Next</button>
        </div>
    </div>
</form>

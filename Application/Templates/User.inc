<section class="container mt-5">
    <section>
        <h1>User Management Area</h1>
        <h4>Hello <?= $this->firstName ?></h4>
        <form method="post" action="/user">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="hidden" name="token" value="<?=$this->token ?>"
                    <label for="first-name">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first-name" value="<?= $this->firstName ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="last-name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last-name" value="<?= $this->lastName ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="email-address">Email Address</label>
                    <input type="text" name="email_address" class="form-control" id="email-address" value="<?= $this->emailAddress ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" value="<?= $this->password ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <?php if ($this->hasValidationError) : ?>
        <div class="alert mt-3 alert-danger">
            <div class="strong">Error</div>
            An error occurred during the update process. Please try again later or contact your application
            administrator.
        </div>
        <?php endif; ?>
    </section>
</section>

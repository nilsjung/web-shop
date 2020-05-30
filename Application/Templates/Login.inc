<section class="user-login-container container">
    <h1 class="mt-5 mb-5">Login</h1>
    <div class="row">
        <div class="col-6">
            <form method="post" action="/login">
                <div class="form-group">
                    <label for="email-address">Email address</label>
                    <input type="email" name="email_address" class="form-control" id="email-address"
                           aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php if ($this->hasValidationError ) : ?>
        <div class="alert mt-3 alert-danger">
            <div class="strong">Validation Error</div>
            Email/password are incorrect. Please try again.
        </div>
    <?php endif; ?>
</section>

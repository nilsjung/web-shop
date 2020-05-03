<section class="container mt-5">
    <div class="row">
        <div class="col-6">
            <form method="post" action="/login">
                <div class="form-group">
                    <label for="email-address">Email address</label>
                    <input type="email" name="email-address" class="form-control" id="email-address"
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
</section>

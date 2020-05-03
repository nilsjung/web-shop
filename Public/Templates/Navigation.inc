<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="/articles">Articles</a>
            <?php if ($this->isAuthenticated) : ?>
                <a class="nav-item nav-link active" href="/user?userId=<?=$this->userId?>">User<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="/logout">Logout</a>
            <?php else :?>
                <a class="nav-item nav-link" href="/login">Login</a>
            <?php endif;?>
        </div>
    </div>
    <a href="/shopping-cart" class="btn my-2 my-sm-0" type="submit">
        <i class="fas fa-shopping-cart"></i>
    </a>
</nav>
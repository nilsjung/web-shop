<div class="articles-container container">
    <h1 class="mt-5 mb-5"><?= $this->title ?></h1>
    <div class="row">
        <?php foreach ( $this->articles as $article ) : ?>
            <div class="col-4">
                <div class="card">
                <img src="<?= $article->getImagePath() ?>" class="card-img-top"
                     alt="<?= $article->getName() ?>">
                    <div class="card-body">
                        <div class="h5 card-title"><?= $article->getName() ?></div>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up the bulk of the
                            card's content.
                        </p>
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Price: <?=$article->getPrice() ?> €</span>
                            <a href="/articles/add-to-cart/?article_id=<?= $article->getId()?>&token=<?= $this->token?>" class="btn btn-primary">
                                <i class="fas fa-cart-plus"></i>
                                <span class=""><?= $article->getInCart() . "/" . $article->getStock()?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
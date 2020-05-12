<section class="articles-container container">
    <h1 class="mt-5 mb-5"><?= $this->title ?></h1>
    <div class="row">
        <?php foreach ( $this->articles as $article ) : ?>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= $article[ "image_path" ] ?>" class="card-img-top"
                             alt="<?= $article[ "article_name" ] ?>">
                        <div class="h5 card-title"><?= $article[ "article_name" ] ?></div>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up the bulk of the
                            card's content.
                        </p>
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-cart-plus"></i>
                            <span class=""><?= "0 /" . $article[ 'stock' ] ?></span>
                        </button>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    </div>
</section>
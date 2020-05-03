<section class="container mt-5">
    <h1><?= $this->title ?></h1>
    <div class="row">
        <?php foreach ( $this->articles as $article ) : ?>
            <div class="col">
                <div class="card" >
                    <div class="card-body">
                        <img src="<?= $article[ "image_path" ] ?>" class="card-img-top" alt="<?= $article["article_name"]?>">
                        <div class="h5 card-title"><?= $article[ "article_name" ] ?></div>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up the bulk of the
                            card's content.
                        </p>
                        <button type="button" class="btn btn-primary">
                            Stock
                            <i class="fas fa-cart-plus" ></i>
                            <span class="badge badge-light"><?= "0 /" . $article['stock']?></span>
                            <span class="sr-only">unread messages</span>
                        </button>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    </div>
</section>
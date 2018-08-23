<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4">Shop</h1>
            </div>
        </div>
    </div >
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group list-group-flush">
                    <?php foreach ($categories as $category) : ?>
                        <li class="list-group-item"><a href="<?= $url->create("?category=$category->category")?>"><?= ucfirst($category->category) ?> (<?= $category->total ?>)</a></li>
                    <?php endforeach ?>
                    <li class="list-group-item"><a href="<?= $url->create("?category=all")?>">See all</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <form class="form-inline" method="get">
                    <input id="search-field" class="search form-control no-border" placeholder="Search" name="search" />
                    <button class="btn btn-outline-dark margin_left10 no-border" name="name" value="DESC">
                        Sort by name
                    </button>
                    <button class="btn btn-outline-dark margin_left10 no-border" name="price" value="ASC">
                        Sort by price
                    </button>
                </form>
                <div class="row ptb-20">
                <?php foreach ($products as $product) : ?>
                    <div class="col-md-4">
                        <article class="col-item">
                            <div class="photo">
                                <div class="options-cart-round">
                                    <form class="product" id="product-<?= $product->id ?>" method="post">
                                        <input type="hidden" name="productId" value="<?= $product->id ?>" />
                                        <button class="btn btn-default" type="submit" title="Add to cart">
                                            <span class="fa fa-shopping-cart"></span>
                                        </button>
                                    </form>
                                    <!-- <button class="btn btn-default" title="Add to cart">
                                        <span class="fa fa-shopping-cart"></span>
                                    </button> -->
                                </div>
                                <a href="#"> <img src="<?= $url->create("/kmom10/shop/htdocs/img/$product->image")?>" class="img-responsive" alt="Product Image" /> </a>
                            </div>
                            <div class="info">
                                <div class="row">
                                    <div class="price-details col-md-12">
                                        <h6 class="title text-center"><a class="text-dark" href="<?= $url->create("shop/product/$product->id")?>"><?= $product->name ?></a></h6>
                                        <!-- <p class="details text-center" style="padding-bottom: 10px">
                                            <?= $product->description ?>
                                        </p> -->
                                        <div class="separator" style="padding-top: 10px">
                                            <span class="price-new">$<?= $product->price ?></span>
                                            <?php if ($product->old_price) : ?>
                                                <span class="price-old">$<?= $product->old_price ?></span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach ?>
                </div>
                <!-- Pagination start -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
                <!-- Pagination end -->
            </div>
        </div>
    </div>
</div>

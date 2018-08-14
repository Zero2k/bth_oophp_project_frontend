<?php
    $url = $this->di->get("url");
?>

<main role="main">
    <div class="jumbotron jumbotron-fluid bg-header text-white">
        <div class="container">
            <div class="row">
                <h1 class="display-4">Shopping Cart</h1>
            </div>
        </div>
    </div >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Product</th>
                                <th scope="col">Available</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                                <td class="align-middle">Product Name Dada</td>
                                <td class="align-middle">In stock</td>
                                <td class="align-middle">
                                    <input style="border-radius: 0" class="form-control" type="number" value="1" />
                                </td>
                                <td class="align-middle">
                                    <select style="border-radius: 0" class="form-control">
                                        <option>M</option>
                                        <option>S</option>
                                        <option>L</option>
                                        <option>XL</option>
                                    </select>
                                </td>
                                <td class="align-middle">$124,90</td>
                                <td class="align-middle text-right"><button class="btn btn-sm btn-danger no-border"><i class="fa fa-trash"></i> </button> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td class="text-right"><strong>$346,90</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <a href="<?= $url->create("shop")?>" class="btn btn-block btn-secondary no-border">Return to Shop</a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <button class="btn btn-block btn-success no-border">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
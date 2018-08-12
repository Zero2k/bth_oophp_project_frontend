<?php

namespace Vibe\Shop;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Shop extends ActiveRecordModel
{
    public function getAllProductsByCategory($category, $limit = 10)
    {
        $sql = 'SELECT Product.* FROM oophp_Product Product
        LEFT JOIN oophp_CategoryProduct CP ON CP.productId = Product.id
        LEFT JOIN oophp_Category Category ON Category.id = CP.categoryId
        WHERE Category.category = ? 
        ORDER BY created DESC LIMIT ?';

        $products = $this->findAllSql($sql, [$category, $limit]);
        $products = array_map(function ($product) {
            $product->id = $product->id;
            $product->userId = $product->userId;
            $product->name = $product->name;
            $product->descriptin = $product->description;
            $product->text = $product->text;
            $product->price = $product->price;
            $product->old_price = $product->old_price;
            $product->image = $product->image;
            $product->stock = $product->stock;
            $product->offer = $product->offer;
            $product->featured = $product->featured;
            return $product;
        }, $products);

        return $products;
    }
}
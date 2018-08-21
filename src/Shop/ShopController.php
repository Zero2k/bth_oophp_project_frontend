<?php

namespace Vibe\Shop;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Vibe\Product\Product;
use \Vibe\Category\CategoryProduct;
use \Vibe\Shop\Shop;
use \Vibe\CartSession\CartSession;

/**
* Routes class.
*/
class ShopController implements ConfigureInterface, InjectionAwareInterface
{
    use InjectionAwareTrait, ConfigureTrait;



    public function init()
    {
        $this->product = new Product();
        $this->product->setDb($this->di->get("database"));

        $this->categoryProduct = new CategoryProduct();
        $this->categoryProduct->setDb($this->di->get("database"));

        $this->shop = new Shop();
        $this->shop->setDb($this->di->get("database"));

        $this->cartSession = new CartSession();
        $this->cartSession->inject(["session" => $this->di->get("session")]);

        $this->session = $this->di->get("session");
    }



    /**
     * Show shop page.
     *
     * @return void
     */
    public function getShop()
    {
        $this->init();
        $title      = "Shop";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $category = isset($_GET["category"]) ? $_GET["category"] : '';
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;

        switch ($category) {
            case 'all':
                $products = $this->product->getProducts($limit);
                break;

            case 'dresses':
                $products = $this->shop->getAllProductsByCategory("dresses", $limit);
                break;

            case 'shirts':
                $products = $this->shop->getAllProductsByCategory("shirts", $limit);
                break;

            case 'shorts':
                $products = $this->shop->getAllProductsByCategory("shorts", $limit);
                break;

            case 'pants':
                $products = $this->shop->getAllProductsByCategory("pants", $limit);
                break;

            default:
                $products = $this->product->getProducts($limit);
                break;
        }

        $data = [
            "products" => $products,
        ];

        $view->add("shop/shop", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show product page.
     *
     * @return void
     */
    public function getProduct($id)
    {
        $this->init();
        $title      = "View Product";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "categories" => $this->categoryProduct->getCategoriesToProduct($id),
            "product" => $this->product->getProduct($id),
        ];

        $view->add("shop/productView", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Show cart page.
     *
     * @return void
     */
    public function getCart()
    {
        $this->init();
        $title      = "View Cart";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        if (isset($_POST["delete"])) {
            $id = $_POST["delete"];
            $size = $_POST["size"];
            $quantity = $_POST["quantity"];
            $this->session->set("message", "delete | ID: $id Size: $size QUANTITY: $quantity");
        } else if (isset($_POST["update"])) {
            $id = $_POST["update"];
            $size = $_POST["size"];
            $quantity = $_POST["quantity"];
            $this->session->set("message", "update | ID: $id Size: $size QUANTITY: $quantity");
        }

        $data = [
            "products" => $this->cartSession->getProducts(),
            "total" => $this->cartSession->calculateTotal(),
        ];

        $view->add("shop/cart", $data);
        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Add product to cart route.
     *
     * @return void
     */
    public function postAddToCart()
    {
        $this->init();

        $id = isset($_POST["productId"]) ? $_POST["productId"] : '';
        $size = isset($_POST["size"]) ? $_POST["size"] : 'S';
        $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : '1';
        $requestType = isset($_POST["requestType"]) ? $_POST["requestType"] : '';

        /* CHECK IF PRODUCT ALREADY EXIST IN SESSION */
        $existingProduct = $this->cartSession->productExists($id, $size);
        $product = $this->product->find("id", $id);

        if (!$existingProduct) {
            if ($product) {
                $this->cartSession->addProduct($product, $quantity, $size);
                $this->session->set("message-$product->id", "Product added to cart!");
            } else {
                $this->session->set("message", "Error!");
            }
        } else if ($existingProduct && $requestType === "ajax") {
            die(header("HTTP/1.0 409 Conflict (Product already added to cart)", true, 409));
        } else {
            $this->session->set("message-$product->id", "Product already added to cart!");
        }

        $this->di->get("response")->redirect($_SERVER["HTTP_REFERER"]);
    }


    /**
     * Remove cart route.
     *
     * @return void
     */
    public function removeCart()
    {
        $this->init();

        $this->session->delete("cart");
        $this->di->get("response")->redirect($_SERVER["HTTP_REFERER"]);
    }
}

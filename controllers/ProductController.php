<?php
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';


class ProductController
{
    public function actionView($id)
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $product = Product::getProductById($id);

        require_once(ROOT .'/views/product/view.php');
        return true;
    }

}
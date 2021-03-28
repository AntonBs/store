<?php

return array(
    'store/product/([0-9]+)'=> 'store/product/view/$1', //actionView in ProductController
    'store/catalog' =>'store/catalog/index', //actionIndex in CatalogController
    'store/category/([0-9]+)'=> 'store/catalog/category/$1',
    'store'=>'site/index', //actionIndex in SiteController
);
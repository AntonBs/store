<?php

return array(
    'store/product/([0-9]+)'=> 'store/product/view/$1', //actionView in ProductController
    'store'=>'site/index', //actionIndex in SiteController
);
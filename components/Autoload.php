<?php
/*
 * До PHP 8.0.0 можно было использовать __autoload() для автозагрузки классов и
 *  интерфейсов. Однако это менее гибкая альтернатива spl_autoload_register(),
 * функция __autoload() объявлена устаревшей в PHP 7.2.0 и удалена в PHP 8.0.0.
 * */

function Autoload($class_name)
{
    $array_path = array(
      '/models/',
      '/components/'
    );

    foreach ($array_path as $path){
        $path = ROOT. $path . $class_name . '.php';
        if (is_file($path))
        {
            include_once $path;
        }
    }
}

spl_autoload_register('Autoload');
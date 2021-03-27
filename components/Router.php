<?php


class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath= ROOT.'/Config/routes.php';
        $this->routes = include($routesPath);
    }
    /**
     * Returns request string
     * @return string
     */
    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }
    public function run()
    {
        // Получить строку запроса

        $uri = $this->getURI();

        //Проверить наличие такого запроса в routes.php

        foreach ($this->routes as $uriPattern => $path){

            //Сравнение $uriPattern и $path
            if (preg_match("~$uriPattern~",$uri)){
                //Определить какой контроллер
                //и action обабатывают зарос

//                echo '<br>'.$uri;
//                echo '<br>'.$uriPattern;
//                echo '<br>'.$path;

                $internalRoute = preg_replace("~$uriPattern~",$path, $uri);

//                echo '<br>'.$internalRoute;

                $segments = explode('/',$internalRoute);

                //Костыль для локального сервера, удалить для хостинга
                if ($segments[0]=='store'){
                    $segments = array_slice($segments,1);
                }
//                var_dump($segments);

                //array_shift - берем первый елемент масива и удаляем его из масива
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));


//                echo '<br>Класс: '.$controllerName;
//                echo '<br>Метод: '.$actionName;
                $parameters = $segments;
//                echo '<pre></pre> ';
//                print_r($parameters);





                //Подключение файла класса- контроллера
                $controllerFile = ROOT. '/Controllers/'. $controllerName .'.php';

                if (file_exists($controllerFile)){
                    include_once($controllerFile);
                }

                //Создать объект, вызвать метода (action)
                $controllerObject = new $controllerName;

                // Вызов action c имененм $actionName у объекта $controllerObject,
                // передавая масив с параметрами $parameters
                $result = call_user_func_array(array($controllerObject,$actionName),$parameters);

//                    $controllerObject->$actionName($parameters);
                if ($result != null){
                    break;
                }
            }

        }


    }
}
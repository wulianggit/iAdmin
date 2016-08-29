<?php

$router->resource('menu', "MenuController");
// 等价于
$router->get('/menu', 'MenuController@index');


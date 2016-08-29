<?php
/**
 * 后台首页路由规则
 */
$router->get('/', 'HomeController@index');
$router->resource('/home', 'HomeController');
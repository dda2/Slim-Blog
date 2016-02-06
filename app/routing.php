<?php

$app->get('/', 'Pamit\Controllers\HomeController:index')
    ->setName('home');

/*
* Admin Route
 */
$app->get('/admin', 'Pamit\Controllers\AdminHomeController:index')
    ->setName('admin');

$app->get('/admin/flash', 'Pamit\Controllers\AdminHomeController:flash')
    ->setName('admin.flash');
/*
* Auth Route
 */
$app->get('/admin/signup', 'Pamit\Controllers\AuthController:getSignup')
    ->setName('signup');

$app->post('/admin/signup', 'Pamit\Controllers\AuthController:postSignup')
    ->setName('post.signup');

$app->get('/admin/signin', 'Pamit\Controllers\AuthController:getSignin')
    ->setName('signin');

$app->post('/admin/signin', 'Pamit\Controllers\AuthController:doSignin')
    ->setName('do.signin');
<?php

// Home page
$app->get('/', "WebLinks\Controller\HomeController::indexAction")
->bind('home');

// Login form
$app->get('/login', "WebLinks\Controller\HomeController::loginAction")
->bind('login');

// Admin page
$app->get('/admin', "WebLinks\Controller\AdminController::indexAction")
->bind('admin');

// Submit link form
$app->match('/link/submit', "WebLinks\Controller\HomeController::linkAction")
->bind('link');

// API : get all links
$app->get('/api/links', "WebLinks\Controller\ApiController::getLinksAction")
->bind('api_links');

// API : get one link
$app->get('/api/link/{id}', "WebLinks\Controller\ApiController::getLinkAction")
->bind('api_link');
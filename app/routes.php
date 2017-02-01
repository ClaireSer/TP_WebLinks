<?php

use Symfony\Component\HttpFoundation\Request;

// Home page
$app->get('/', function () use ($app) {
    $links = $app['dao.link']->findAll();
    return $app['twig']->render('index.html.twig', array('links' => $links));
});

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// $app->get('/link', function(Request $request) use ($app) {
//     return 
// })->bind('link');

// // revoir
// $app->match('/link/submit', function ($id, Request $request) use ($app) {
//     $linkFormView = null;
//     if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
//         // A user is fully authenticated : he can add links
//         $link = new Link();
//         $user = $app['user'];
//         $link->setAuthor($user);
//         $linkForm = $app['form.factory']->create(LinkType::class, $link);
//         $linkForm->handleRequest($request);
//         if ($linkForm->isSubmitted() && $linkForm->isValid()) {
//             $app['dao.link']->save($link);
//             $app['session']->getFlashBag()->add('success', 'Your link was successfully added.');
//         }
//         $linkFormView = $linkForm->createView();
//     }
//     $links = $app['dao.link']->findAll();

//     return $app['twig']->render('link.html.twig', array(
//         'linkForm' => $linkFormView));
// })->bind('link');
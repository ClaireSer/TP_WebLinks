<?php

use Symfony\Component\HttpFoundation\Request;
use WebLinks\Domain\Link;
use WebLinks\Form\Type\LinkType;

// Home page
$app->get('/', function () use ($app) {
    $links = $app['dao.link']->findAll();
    return $app['twig']->render('index.html.twig', array('links' => $links));
})->bind('home');


// Login form
$app->get('/login', function (Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');


// Submit link form
$app->match('/link/submit', function (Request $request) use ($app) {
    $linkFormView = null;
    // on vérifie si l'utilisateur est authentifié
    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
        // on instancie un objet $link
        $link = new Link();
        // on lie le lien à un utilisateur
        $user = $app['user'];
        $link->setAuthor($user);
        // on crée le formulaire via la classe LinkType 
        $linkForm = $app['form.factory']->create(LinkType::class, $link);
        // le formulaire doit gérer la requête
        $linkForm->handleRequest($request);
        // si le lien est soumis et qu'il est valide, alors on le sauve dans la bdd
        // et on affiche un message de succès
        if ($linkForm->isSubmitted() && $linkForm->isValid()) {
            $app['dao.link']->save($link);
            $app['session']->getFlashBag()->add('success', 'Your link was successfully added.');
        }
        // on affiche la vue du formulaire
        $linkFormView = $linkForm->createView();
    }
    $links = $app['dao.link']->findAll();
    return $app['twig']->render('link.html.twig', array(
        'linkForm' => $linkFormView
    ));
})->bind('link');

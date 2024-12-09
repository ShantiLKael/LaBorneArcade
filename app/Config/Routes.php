<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);

//$routes->group('', ['filter' => 'invite'], function($routes) {
	// Page vitrine
	$routes->get('/'                  , 'HomeController::index');
	$routes->get('/qui-sommes-nous'   , 'HomeController::quiSommesNous');
	$routes->get('/faq'               , 'HomeController::faq');
	$routes->get('/condition-de-vente', 'HomeController::cgv');
	$routes->match(['get', 'post'], '/contact', 'HomeController::contact');

	// Connexion
	$routes->get('/deconnexion', 'LoginController::deconnexion');
	$routes->match(['get', 'post'],'/connexion'  , 'LoginController::connexion');
	$routes->match(['get', 'post'],'/inscription', 'LoginController::inscription');
	$routes->match(['get', 'post'],'/connexion/oubli-mdp'       , 'LoginController::oubliMdp');
	$routes->match(['get', 'post'],'/connexion/oubli-mdp/(:any)', 'LoginController::resetMdp/$1');

	// Blog articles
	$routes->get('/blog-articles'       , 'ArticleBlogController::index');
	$routes->get('/blog-articles/(:num)', 'ArticleBlogController::voirArticle/$1');

	// Bornes
	$routes->get('/bornes'       , 'ControleurBorne::indexBorne');
	$routes->match(['get', 'post'], '/bornes/(:num)', 'ControleurBorne::voirBorne/$1');
	$routes->match(['get', 'post'], '/borne-perso/(:num)', 'ControleurBorne::editBorne/$1');
	$routes->match(['get', 'post'], '/borne-perso/', 'ControleurBorne::editBorne');

	// Panier
	$routes->get('/panier', 'CommandeController::panier');
	$routes->get('/panier/delete-borne/(:num)', 'CommandeController::suppressionBorne/$1');
//});

//$routes->group('', ['filter' => 'auth'], function($routes) {
	$routes->get  ('/commandes', 'CommandeController::index');
	$routes->match(['get', 'post'], '/profile', 'LoginController::profile');
//});

//$routes->group('', ['filter' => 'admin'], function($routes) {
	$routes->match(['get', 'post'], 	'/admin/bornes'		, 'AdminController::adminBorne');
	$routes->match(['get', 'post'], 	'/admin/contact'	, 'AdminController::adminContact');
	$routes->match(['get', 'post'], 	'/admin/articles'	, 'AdminController::adminArticle');
	$routes->match(['get', 'post'], 	'/admin/faqs'		, 'AdminController::adminFaq');
	$routes->match(['get', 'post'],	'/admin/theme'		, 'AdminController::adminTheme');
//});

/** Route pour le cronjob */
$routes->cli('/cronjob', 'ControleurCronJob::index');

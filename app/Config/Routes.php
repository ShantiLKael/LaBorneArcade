<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->group('', ['filter' => 'invite'], function($routes) {
	// Page vitrine
	$routes->get('/'                  , 'ControleurHome::index');
	$routes->get('/qui-sommes-nous'   , 'ControleurHome::quiSommesNous');
	$routes->get('/faq'               , 'ControleurHome::faq');
	$routes->get('/condition-de-vente', 'ControleurHome::cgv');
	$routes->match(['get', 'post'], '/contact', 'ControleurHome::contact');

	// Connexion
	$routes->get('/connexion'  , 'LoginController::connexion');
	$routes->get('/inscription', 'LoginController::inscription');
	$routes->get('/connexion/oubli-mdp'       , 'LoginController::oubliMdp');
	$routes->get('/connexion/oubli-mdp/(:any)', 'LoginController::resetMdp');

	// Blog articles
	$routes->get('/blog-articles'       , 'ArticleBlogController::index');
	$routes->get('/blog-articles/(:num)', 'ArticleBlogController::voirArticle/$1');

	// Bornes
	$routes->get('/bornes'       , 'ControleurBorne::index');
	$routes->get('/bornes/(:any)', 'ControleurBorne::index/$1');
	$routes->get('/bornes/(:num)', 'ControleurBorne::voirBorne');
	$routes->match(['get', 'post'], '/bornes-perso/(:num)', 'ControleurBorne::editBorne');

	// Panier
	$routes->get('/panier', 'ControleurCommande::panier');
//});

//$routes->group('', ['filter' => 'auth'], function($routes) {
	$routes->get  ('/commandes', 'ControleurCommande::index');
	$routes->match(['get', 'post'], '/profile', 'LoginController::profile');
//});

//$routes->group('', ['filter' => 'admin'], function($routes) {
	$routes->match(['get', 'post', 'delete'], '/admin/bornes'  , 'AdminController::adminBorne');
	$routes->match(['get', 'post', 'delete'], '/admin/contact' , 'AdminController::adminContact');
	$routes->match(['get', 'post', 'delete'], '/admin/articles', 'AdminController::adminArticle');
	$routes->match(['get', 'post', 'delete'], '/admin/faqs'    , 'AdminController::adminFaq');
//});

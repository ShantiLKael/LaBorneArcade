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
	$routes->get('/blog-articles/(:num)', 'ArticleBlogController::index');

	// Bornes
	$routes->get('/bornes'       , 'BorneController::index');
	$routes->get('/bornes/(:num)', 'BorneController::voirBorne');
	$routes->match(['get', 'post'], '/bornes-perso/(:num)', 'BorneController::editBorne');

	// Panier
	$routes->get('/panier', 'CommandeController::panier');
//});

//$routes->group('', ['filter' => 'auth'], function($routes) {
	$routes->get  ('/commandes', 'CommandeController::index');
	$routes->match(['get', 'post'], '/profile', 'LoginController::profile');
//});

//$routes->group('', ['filter' => 'admin'], function($routes) {
	$routes->match(['get', 'post', 'delete'], '/admin/bornes'  , 'AdminController::index');
	$routes->match(['get', 'post', 'delete'], '/admin/contact' , 'AdminController::adminContact');
	$routes->match(['get', 'post', 'delete'], '/admin/articles', 'AdminController::adminArticle');
	$routes->match(['get', 'post', 'delete'], '/admin/faqs'    , 'AdminController::adminFaq');
//});
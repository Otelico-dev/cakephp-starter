<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Media',
    ['path' => '/media'],
    function (RouteBuilder $routes) {
    	// $routes->connect('/:plugin/:controller/:action/*');
    	// $routes->connect('/:plugin/:controller/:action/:id');
        $routes->fallbacks(DashedRoute::class);
    }
);

// Router::prefix('admin', function ($routes) {
// 	Router::plugin(
// 	    'Media',
// 	    ['path' => '/media'],
// 	    function (RouteBuilder $routes) {
// 	    	// $routes->connect('/:plugin/:controller/:action/*');
// 	    	// $routes->connect('/:plugin/:controller/:action/:id');
// 	        $routes->fallbacks(DashedRoute::class);
// 	    }
// 	);
//     // $routes->plugin('Media', function ($routes) {
//     //     $routes->fallbacks(DashedRoute::class);
//     // });
// });

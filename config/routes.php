<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));

    /*
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered through `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');

    // Rotas publicas
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/recuperar-senha', ['controller' => 'Users', 'action' => 'rescuePassword']);
    $routes->connect('/nova-senha/:token', ['controller' => 'Users', 'action' => 'changePassword']);

    // Rotas privadas
    $routes->connect('/sair', ['controller' => 'Users', 'action' => 'logout']);

    // Users
    $routes->connect('/usuarios', ['controller' => 'Users', 'action' => 'index']);
    $routes->connect('/usuarios/cadastrar', ['controller' => 'Users', 'action' => 'add']);
    $routes->connect('/usuarios/editar/:id', ['controller' => 'Users', 'action' => 'edit'], ['pass' => ['id'], '_name' => 'editar_users']);
    $routes->connect('/usuarios/visualizar/:id', ['controller' => 'Users', 'action' => 'view'], ['pass' => ['id'], '_name' => 'visualizar_users']);

    // Activities
    $routes->connect('/atividades', ['controller' => 'Activities', 'action' => 'index']);
    $routes->connect('/atividades/cadastrar', ['controller' => 'Activities', 'action' => 'add']);
    $routes->connect('/atividades/editar/:id', ['controller' => 'Activities', 'action' => 'edit'], ['pass' => ['id'], '_name' => 'editar_activities']);
    $routes->connect('/atividades/visualizar/:id', ['controller' => 'Activities', 'action' => 'view'], ['pass' => ['id'], '_name' => 'visualizar_activities']);

    // Instructors
    $routes->connect('/instrutores', ['controller' => 'Instructors', 'action' => 'index']);
    $routes->connect('/instrutores/cadastrar', ['controller' => 'Instructors', 'action' => 'add']);
    $routes->connect('/instrutores/editar/:id', ['controller' => 'Instructors', 'action' => 'edit'], ['pass' => ['id'], '_name' => 'editar_instructors']);
    $routes->connect('/instrutores/visualizar/:id', ['controller' => 'Instructors', 'action' => 'view'], ['pass' => ['id'], '_name' => 'visualizar_instructors']);

    // Guests
    $routes->connect('/hospedes', ['controller' => 'Guests', 'action' => 'index']);
    $routes->connect('/hospedes/cadastrar', ['controller' => 'Guests', 'action' => 'add']);
    $routes->connect('/hospedes/editar/:id', ['controller' => 'Guests', 'action' => 'edit'], ['pass' => ['id'], '_name' => 'editar_guests']);
    $routes->connect('/hospedes/visualizar/:id', ['controller' => 'Guests', 'action' => 'view'], ['pass' => ['id'], '_name' => 'visualizar_guests']);

    $routes->fallbacks(DashedRoute::class);
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */

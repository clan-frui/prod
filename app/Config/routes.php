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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/index.ctp)...
 */
	// Router::connect('/pages/index', array('controller' => 'pages', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */

    Router::connect('/', array('controller' => 'accueils', 'action' => 'index'));

    Router::connect('/accueil/*', 			               array('controller' => 'accueils', 'action' => 'index'));

    Router::connect('/ajax/actu/:action/*', 			   array('controller' => 'actualites', 'ajax' => true));
    Router::connect('/actu/:action/*', 				       array('controller' => 'actualites'));
    Router::connect('/actu/*',                             array('controller' => 'actualites'));

    Router::connect('/ajax/admin/:action/*', 			   array('controller' => 'administrations', 'ajax' => true));
    Router::connect('/admin/:action/*', 				       array('controller' => 'administrations'));
    Router::connect('/admin/*',                             array('controller' => 'administrations'));

    Router::connect('/ajax/forums/:action/*', 			   array('controller' => 'forums', 'ajax' => true));
    Router::connect('/forums/:action/*', 				       array('controller' => 'forums'));
    Router::connect('/forums/*',                             array('controller' => 'forums'));

    Router::connect('/ajax/users/:action/*', 			   array('controller' => 'users', 'ajax' => true));
    Router::connect('/users/:action/*', 				       array('controller' => 'users'));
    Router::connect('/users/*',                             array('controller' => 'users'));




    /**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'static', 'action' =>'index','home'));
	
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	//Router::connect('/', array('controller' => 'static', 'action' => 'index','home'));
	Router::connect('/admins/:action/*', array('controller' => 'Admins'));
	Router::connect('/static_pages/:action/*', array('controller' => 'static_pages'));
	Router::connect('/users/:action/*', array('controller' => 'users'));
	Router::connect('/about_us', array('controller' => 'static', 'action' => 'index','about_us'));		
	Router::connect('/index', array('controller' => 'static', 'action' => '',''));	
	Router::connect('/about_us', array('controller' => 'static', 'action' => 'index','about_us'));		
	Router::connect('/terms', array('controller' => 'static', 'action' => 'index','terms'));
	Router::connect('/privacy', array('controller' => 'static', 'action' => 'index','privacy'));		
	Router::connect('/404', array('controller' => 'static', 'action' => 'index','404'));	
	Router::connect('/admin/*', array('controller' => 'admins', 'action' => 'login'));
	
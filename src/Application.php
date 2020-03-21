<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use App\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use App\Middleware\AppI18nMiddleware;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{
	/**
	 * {@inheritDoc}
	 */
	public function bootstrap()
	{
		// Call parent to load bootstrap from files.
		parent::bootstrap();

		if (PHP_SAPI === 'cli') {
			$this->bootstrapCli();
		}

		/*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
		if (Configure::read('debug')) {
			$this->addPlugin(\DebugKit\Plugin::class);
		}

		// Load more plugins here
		$this->addPlugin('DataTables');

		$this->addPlugin('Crud');

		$this->addPlugin(\CakeDC\Users\Plugin::class, [
			'routes' => true,
			'bootstrap' => true
		]);
		Configure::write('Users.config', ['users']);


		$this->addPlugin('Cors', [
			'bootstrap' => true,
			'routes' => false
		]);

		$this->addPlugin('ADmad/I18n');

		$this->addPlugin('LilHermit/Bootstrap4', ['bootstrap' => true]);
		$this->addPlugin('AdminTheme');
		$this->addPlugin('Media', ['routes' => true]);
	}

	/**
	 * Setup the middleware queue your application will use.
	 *
	 * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
	 * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
	 */
	public function middleware($middlewareQueue)
	{
		$middlewareQueue
			// Catch any exceptions in the lower layers,
			// and make an error page/response
			->add(new ErrorHandlerMiddleware(null, Configure::read('Error')))

			// Handle plugin/theme assets like CakePHP normally does.
			->add(new AssetMiddleware([
				'cacheTime' => Configure::read('Asset.cacheTime')
			]))

			// Add routing middleware.
			// If you have a large number of routes connected, turning on routes
			// caching in production could improve performance. For that when
			// creating the middleware instance specify the cache config name by
			// using it's second constructor argument:
			// `new RoutingMiddleware($this, '_cake_routes_')`
			->add(new RoutingMiddleware($this));

		$middlewareQueue
			->add(new AppI18nMiddleware([
				// If `true` will attempt to get matching languges in "languages" list based
				// on browser locale and redirect to that when going to site root.
				'detectLanguage' => false,
				// Default language for app. If language detection is disabled or no
				// matching language is found redirect to this language
				'defaultLanguage' =>  Configure::read('I18n.defaultLanguage'),
				// Languages available in app. The keys should match the language prefix used
				// in URLs. Based on the language the locale will be also set.
				'languages' => Configure::read('I18n.languages')
			]));

		return $middlewareQueue;
	}

	/**
	 * @return void
	 */
	protected function bootstrapCli()
	{
		try {
			$this->addPlugin('Bake');
		} catch (MissingPluginException $e) {
			// Do not halt if the plugin is missing
		}

		$this->addPlugin('Migrations');

		// Load more plugins here
	}
}

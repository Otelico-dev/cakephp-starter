<?php

namespace App\Middleware;

use Cake\Core\Configure;
use Cake\Http\ServerRequest;
use Cake\I18n\I18n;
use Psr\Http\Message\ResponseInterface;
use ADmad\I18n\Middleware\I18nMiddleware;

class AppI18nMiddleware extends I18nMiddleware
{
	/**
	 * Sets appropriate locale and lang to I18n::locale() and App.language config
	 * respectively based on "lang" request param.
	 *
	 * @param \Cake\Http\ServerRequest $request The request.
	 * @param \Psr\Http\Message\ResponseInterface $response The response.
	 * @param callable $next Callback to invoke the next middleware.
	 *
	 * @return \Psr\Http\Message\ResponseInterface A response
	 */
	public function __invoke(ServerRequest $request, ResponseInterface $response, $next)
	{
		$config = $this->getConfig();

		$langs = $config['languages'];

		$requestParams = $request->getAttribute('params');

		$lang = isset($requestParams['lang']) ? $requestParams['lang'] : $config['defaultLanguage'];

		if (isset($langs[$lang])) {
			I18n::setLocale($langs[$lang]['locale']);
		} else {
			I18n::setLocale($lang);
		}

		Configure::write('App.language', $lang);
		$request = $request->withParam('lang', $lang);

		return $next($request, $response);
	}
}

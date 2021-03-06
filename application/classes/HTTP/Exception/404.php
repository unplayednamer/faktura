<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Exception class "HTTP_Exception_404"
 *
 * @category    Controller
 * @package     Faktura
 * @author      Leonard Fischer <post@leonardfischer.de>
 * @copyrights  2014 Leonard Fischer
 * @version     1.0
 */
class HTTP_Exception_404 extends Kohana_HTTP_Exception_404
{
	/**
	 * Generate a Response for the 403 Exception.
	 *
	 * @return  Response
	 */
	public function get_response()
	{
		$content = View::factory('_error')
			->set('code', $this->getCode())
			->set('message', $this->getMessage());

		if (Auth::instance()->get_user() === null)
		{
			$view = View::factory('_login')
				->set('basedir', Kohana::$base_url);
		}
		else
		{
			$view = View::factory('_base')
				->set('content', $content)
				->set('user_roles', Auth::instance()->get_user()->get_roles())
				->set('basedir', Kohana::$base_url);
		} // if

		return Response::factory()
			->status(404)
			->body($view->render());
	} // function
} // class
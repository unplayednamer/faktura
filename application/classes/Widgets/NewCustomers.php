<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Widget class "New customers"
 *
 * @category    Widgets
 * @package     Faktura
 * @author      Leonard Fischer <post@leonardfischer.de>
 * @copyrights  2014 Leonard Fischer
 * @version     1.0
 * @since       1.2
 */
class Widgets_NewCustomers extends Widgets_Base
{
	/**
	 * The widgets name.
	 */
	const NAME = 'New customers';

	/**
	 * The widgets template
	 */
	const TEMPLATE = 'widgets/new_customers';

	/**
	 * Defines, if this widget is configurable.
	 */
	const CONFIGURABLE = false;

	/**
	 * Defines, how wide this widget is.
	 */
	const WIDTH = 1;


	/**
	 * Method for returning the widget name.
	 *
	 * @return  string
	 */
	public function get_name()
	{
		return __('New customers in :month', array(':month' => strftime('%B', strtotime('-1 MONTH'))));
	} // function


	/**
	 * Method for initializing the widget.
	 *
	 * @return  self
	 */
	public function init()
	{
		$this->template_data = array(
			'customers' => ORM::factory('customer')->where('created_at', 'BETWEEN', array(date('Y-m-01', strtotime('-1 MONTH')), date('Y-m-00')))->count_all()
		);

		return $this;
	} // function
} // class
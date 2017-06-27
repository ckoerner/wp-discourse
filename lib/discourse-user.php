<?php
/**
 * Handles Discourse User Synchronization.
 *
 * @package WPDiscourse
 */

namespace WPDiscourse\DiscourseUser;

use WPDiscourse\Utilities\Utilities as DiscourseUtilities;

/**
 * Class DiscourseUser
 */
class DiscourseUser {

	/**
	 * Gives access to the plugin options.
	 *
	 * @access protected
	 * @var mixed|void
	 */
	protected $options;

	/**
	 * DiscourseUser constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'setup_options' ) );
		add_filter( 'user_contactmethods', array( $this, 'extend_user_profile' ) );
	}

	/**
	 * Setup the plugin options.
	 */
	public function setup_options() {
		$this->options = DiscourseUtilities::get_options();
	}

	/**
	 * Adds 'discourse_username' to the user_contactmethods array.
	 *
	 * @param array $fields The array of contact methods.
	 *
	 * @return mixed
	 */
	public function extend_user_profile( $fields ) {
		if ( ! empty( $this->options['hide-discourse-name-field'] ) ) {

			return $fields;
		} else {
			$fields['discourse_username'] = 'Discourse Username';
		}

		return $fields;
	}
}
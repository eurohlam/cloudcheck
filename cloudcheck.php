<?php
/**
 * Plugin Name: Cloudcheck Integration
 * Plugin URI: https://wordpress.org/plugins/cloudcheck_integration/
 * Description: Integration with cloudcheck service for electronic identification verification. Only for New Zealand and Australia
 * Version: 1.0.0
 * Author: Roundkick.Studio, eurohlam
 * Author URI: https://roundkick.studio
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * License: GPLv2 or later
 */

if (!defined('ABSPATH')) exit;

include_once 'class-cloudcheck-integration.php';
include_once 'cloudcheck-shortcodes.php';

define('CLOUDCHECK_INT_VERSION', '1.0.0');

if (!class_exists('WP_Cloudcheck_Int')) {
	class WP_Cloudcheck_Int {
		/**
		* Plugin's options
		*/
	 	private $options_group = 'cloudcheck_int';
	 	private $url_option = 'cloudcheck_url';
		private $accessKey_option = 'cloudcheck_access_key';
		private $secret_option = 'cloudcheck_secret';

		private $db_table_name = 'cc_message_log';

		static function activate() {
		   	global $wpdb;

 			$table_name = $wpdb->prefix . 'cc_message_log';
			$sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			  endpoint varchar(20) NOT NULL,
			  request longtext CHARACTER SET utf8 NOT NULL,
			  response longtext CHARACTER SET utf8 NOT NULL,
			  filepath varchar(50),
			  PRIMARY KEY (id)
			) DEFAULT CHARSET=utf8;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
        }

		static function deactivate() {
			//nothing so far
		}

		static function uninstall() {
		   	global $wpdb;
			delete_option( 'cloudcheck_url' );
			delete_option( 'cloudcheck_access_key' );
			delete_option( 'cloudcheck_secret' );

 			$table_name = $wpdb->prefix . 'cc_message_log';
			$sql = "DROP TABLE IF EXISTS $table_name";

			$wpdb->query( $sql );
        }

		function __construct() {
			add_action('admin_menu', array( $this, 'cloudcheck_menu'));
			add_action('wp_ajax_cloudcheck_send_request', array( $this,'cloudcheck_send_request'));
			add_action('wp_ajax_cloudcheck_send_email', array( $this,'send_pdf_by_email'));
			add_action('init', 'cloudcheck_shortcodes_init');
		}

		/**
		* Send request to cloudcheck
		*/
		function cloudcheck_send_request() {
		   	global $wpdb;

			$accessKey = get_option($this->accessKey_option);
			$secret = get_option($this->secret_option);
			$url = get_option($this->url_option);
			$request = stripcslashes($_POST['request']);
			$path = $_POST['path'];
			error_log('Cloudcheck got request from AJAX for endpoint:' . $path);
			error_log('Cloudcheck got request from AJAX: ' . $request);

			if (!empty($accessKey) && !empty($secret) && !empty($url) && !empty($path)) {
				$cloudcheckInt = new Cloudcheck_Integration();
				$cloudcheckRequest = $cloudcheckInt->prepare_cloudcheck_parameters($accessKey, $secret, $path, $request);
				error_log('Cloudcheck request: ' . json_encode($cloudcheckRequest));
				$result = $cloudcheckInt->send_request($url . $path, $cloudcheckRequest);
				error_log('Cloudcheck response: ' . $result);

				$wpdb->insert(
		 			$wpdb->prefix . $this->db_table_name,
					array(
					'time' => current_time( 'mysql' ),
					'endpoint' => $path,
					'request' => json_encode($cloudcheckRequest),
					'response' => $result,
					)
				);

				echo $result;
			} else {
				error_log('Cloudcheck Integration plugin error: empty one or several required parameters - accessKey, secret, url or path. Please check settings of Cloudcheck Integration plugin');
				echo '{"Cloudcheck Integration plugin error": "empty one or several required parameters - accessKey, secret, url or path"}';
			}
			wp_die();
		}

		function send_pdf_by_email() {
	        $subject = 'Electronic Verification Identification Report';
	        $body = 'Please refer to the attached PDF for more details';
	        $headers = array('Content-Type: text/html; charset=UTF-8');
			$filepath = $_POST['filepath'];
			$emailList = $_POST['emaillist'];

			error_log("Cloudcheck send PDF: " . $filepath);
			error_log("Cloudcheck send to: " . $emailList);

	        wp_mail( $emailList, $subject, $body, $headers, $filepath );

			echo '{ "result" : "success" }';
			wp_die();
	    }

		function cloudcheck_settings() {
			register_setting( $this->options_group, $this->url_option );
			register_setting( $this->options_group, $this->accessKey_option );
			register_setting( $this->options_group, $this->secret_option );
		}

		function cloudcheck_menu() {
		  	add_action('admin_init', array( $this,'cloudcheck_settings'));
			add_options_page('Cloudcheck Integration', 'Cloudcheck Integration', 'manage_options', 'cloudcheck-int', array( $this,'cloudcheck_options_page'));
		}


		/**
		* Admin options page
		*/
		function cloudcheck_options_page() {
			?>
		    <div class="wrap">
		        <h2>Cloudcheck Integration</h2>
		        <p>Cloudcheck is an electronic identification verification (EV) tool that allows you to verify the identity of your customer using biometric checks, Australian and New Zealand data sources and global watchlists in one easy step. More details about
		            <a href="https://www.verifidentity.com/cloudcheck/">Cloudcheck</a></p>
		        <p>Version: <?php echo CLOUDCHECK_INT_VERSION ?></p>
		        <div>
		            <form method="post" action="options.php">
		            <?php
						settings_fields($this->options_group);
						do_settings_sections($this->options_group);
					?>
						<table class="form-table">
			            	<tr valign="top">
								<th scope="row">Cloudcheck URL</th>
								<td>
									<input type="url" class="regular-text" name="cloudcheck_url" value="<?php echo get_option($this->url_option) ?>" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">Cloudcheck Access Key</th>
								<td>
									<input type="text" class="regular-text" name="cloudcheck_access_key" value="<?php echo get_option($this->accessKey_option) ?>" />
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">Cloudcheck Secret Key</th>
								<td>
									<input type="text" class="regular-text" name="cloudcheck_secret" value="<?php echo get_option($this->secret_option) ?>" />
								</td>
							</tr>
						</table>
						<input type="hidden" name="page_options" value="cloudcheck_url,cloudcheck_access_key,cloudcheck_secret" />
						<p class="submit">
							<input class="button-primary" type="submit" value="Save Changes" />
						</p>
					</form>
				</div>
			</div>
			<?php
		}

	} //end class WP_Cloudcheck_Int
}


if (class_exists('WP_Cloudcheck_Int')) {
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('WP_Cloudcheck_Int', 'activate'));
	register_deactivation_hook(__FILE__, array('WP_Cloudcheck_Int', 'deactivate'));
	register_uninstall_hook(__FILE__, array('WP_Cloudcheck_Int', 'uninstall'));
	// instantiate the plugin class
	$wp_plugin = new WP_Cloudcheck_Int();
}
?>

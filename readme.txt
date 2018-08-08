=== Cloudcheck Integration ===
Contributors: eurohlam, gvadalahara
Tags: cloudcheck, integration, identification verification
Requires at least: 4.9
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Integration with cloudcheck service for electronic identification verification. Only for New Zealand and Australia

== Description ==

Wordpress plugin for integration with Cloudcheck service for electronic identification verification. Only for New Zealand and Australia
www.verifidentity.com/cloudcheck


== Configuration ==

* Firstly, you have to configure cloudcheck endpoint and credentials. Navigate to Settings -> Cloudcheck Integration

* Secondly, you have to create a page that will be showing Cloudcheck forms. Forms must be added into page via predefined shortcodes like below:
[cloudcheck_main_form]
	[cloudcheck_basic_info]
	[cloudcheck_nz_passport]
	[cloudcheck_nz_driving_license]
	[cloudcheck_emails]
[/cloudcheck_main_form] 

To run the integration your page has to include at least the minimal structure:
[cloudcheck_main_form]
	[cloudcheck_basic_info]
[/cloudcheck_main_form] 

Other shortcodes are optional. 


== Frequently Asked Questions ==



== Changelog ==

1.0.0
* Pilot version

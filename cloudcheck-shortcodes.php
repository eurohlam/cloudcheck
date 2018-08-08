<?php
function cloudcheck_shortcodes_init()
{

    function cloudcheck_main_form_shortcode($atts = [], $content = null)
    {
        $form = '<head><link rel="stylesheet" href="/wp-content/plugins/cloudcheck/css/bootstrap.css"></head>
            <section id="cloudcheck_section">
                <div class="container"><div class="row">
                <form id="cloudcheckForm">'
                    . do_shortcode($content)
		            . '<div id="success"></div>
                    <div class="row">
                    <div class="form-group col-xs-12">
                        <button id="btnSubmit" class="btn btn-success btn-lg" type="submit">Send</button>
                    </div>
                    </div>
                </form>
                </div></div>
            </section>
		    <script type="text/javascript" src="/wp-content/plugins/cloudcheck/js/cloudcheck.js"></script>';
        return $form;
    }
    add_shortcode('cloudcheck_main_form', 'cloudcheck_main_form_shortcode');


	/** Shortcode that shows basic fields always required for verification:
	 *  first name, middle name, surname, address
	 */
    function cloudcheck_basic_info_shortcode($atts = [], $content = null)
    {
		$info = '<div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>Given Name</label>
                            <input id="name" class="form-control" required type="text" placeholder="Given Name" />
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>Middle Name</label>
                            <input id="middlename" class="form-control"  type="text" placeholder="Middle Name"/>
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>Family Name</label>
                            <input id="surname" class="form-control" required type="text" placeholder="Family Name"/>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>Date of birth</label>
                            <input id="dateofbirth" class="form-control" required type="date" placeholder="Date of birth" />
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>Postcode</label>
                            <input id="postcode" class="form-control" required type="text" placeholder="Postcode" />
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>City</label>
                            <input id="city" class="form-control" required type="text" placeholder="City"/>
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>Suburb</label>
                            <input id="suburb" class="form-control" required type="text" placeholder="Suburb"/>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>Street</label>
                            <input id="street" class="form-control" required type="text" placeholder="Street"/>
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls">
							<label>Street number</label>
                            <input id="streetnumber" class="form-control" required type="text" placeholder="Street number" />
                        </div>
                    </div>';

        return $info;
    }
    add_shortcode('cloudcheck_basic_info', 'cloudcheck_basic_info_shortcode');


	/** Shortcode that shows fields for verification by NZ passport:
	 *  passport number, passport expiry
	 */
    function cloudcheck_nz_passport_shortcode($atts = [], $content = null)
    {
        $passport = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Passport number</label>
                <input id="passportnumber" class="form-control" type="text" placeholder="Passport number" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Passport Expiry</label>
                <input id="passportexpiry" class="form-control" type="date" placeholder="Passport expiry" />
            </div></div>';

        return $passport;
    }
    add_shortcode('cloudcheck_nz_passport', 'cloudcheck_nz_passport_shortcode');


	/** Shortcode that shows fields for verification by NZ driving license:
	 *  driving license number, driving llicense version
	 */
    function cloudcheck_nz_driving_license_shortcode($atts = [], $content = null)
    {
        $driving = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Driver License Number</label>
                <input id="driverlicensenumber" class="form-control" type="text" placeholder="Driver license number" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Driver License Version</label>
                <input id="driverlicenseversion" class="form-control" type="text" placeholder="Driver license version" />
            </div></div>';

        return $driving;
    }
    add_shortcode('cloudcheck_nz_driving_license', 'cloudcheck_nz_driving_license_shortcode');


	/** Shortcode that shows email fields:
	 *  Client email, Agent email, Administrator email
	 */
    function cloudcheck_emails_shortcode($atts = [], $content = null)
    {
        $emails = '<div class="row">
                       <div class="row control-group">
                          <div class="form-group col-xs-12 floating-label-form-group controls">
							  <label>Client email</label>
                              <input id="clientemail" class="form-control" required type="email" placeholder="Client email"/>
                          </div>
                       </div>
                       <div class="row control-group">
                          <div class="form-group col-xs-12 floating-label-form-group controls">
							  <label>Agent email</label>
                              <input id="agentemail" class="form-control" required type="email" placeholder="Agent email"/>
                          </div>
                          <div class="form-group col-xs-12 floating-label-form-group controls">
							  <label>Administrator email</label>
                              <input id="adminemail" class="form-control" required type="email" placeholder="Administrator email" />
                          </div>
                       </div>
                    </div>';
        return $emails;
    }
    add_shortcode('cloudcheck_emails', 'cloudcheck_emails_shortcode');
}

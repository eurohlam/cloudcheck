<?php
function cloudcheck_shortcodes_init()
{

	/** Enclosing main shortcode that shows the main container form.
	 *  All other shortcodes must be placed inside this one.
	 */
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
                <input id="nz_passportnumber" class="form-control" type="text" pattern="^[A-Za-z]{2}[0-9]{6}$" placeholder="Passport number" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Passport Expiry</label>
                <input id="nz_passportexpiry" class="form-control" type="date" placeholder="Passport expiry" />
            </div></div>';

        return $passport;
    }
    add_shortcode('cloudcheck_nz_passport', 'cloudcheck_nz_passport_shortcode');


	/** Shortcode that shows fields for verification by NZ driving license via NZTA:
	 *  driving license number, driving llicense version
	 */
    function cloudcheck_nz_driving_license_shortcode($atts = [], $content = null)
    {
        $driving = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Driver License Number</label>
                <input id="nz_driverlicensenumber" class="form-control" type="text" pattern="^[A-Za-z]{2}[0-9]{6}$" placeholder="Driver license number" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Driver License Version</label>
                <input id="nz_driverlicenseversion" class="form-control" type="number" pattern="^[0-9]{3}$" title="" placeholder="Driver license version" />
            </div></div>';

        return $driving;
    }
    add_shortcode('cloudcheck_nz_driving_license', 'cloudcheck_nz_driving_license_shortcode');


	/** Shortcode that shows fields for verification by vehicle plate number via NZTA:
	 *  vehicle number plate
	 */
    function cloudcheck_nz_vehicle_plate_number_shortcode($atts = [], $content = null)
    {
        $plate = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Vehicle Plate Number</label>
                <input id="nz_vehicleplatenumber" class="form-control" type="text" pattern="^[A-Za-z0-9]{1,6}$" title="Plate number can contain not more than 6 digits and letters" placeholder="Vehicle plate number" />
            </div></div>';

        return $plate;
    }
    add_shortcode('cloudcheck_nz_vehicle_plate_number', 'cloudcheck_nz_vehicle_plate_number_shortcode');


	/** Shortcode that shows fields for verification by NZ birth certificate:
	 *  birthcertificate
	 */
    function cloudcheck_nz_birth_certificate_shortcode($atts = [], $content = null)
    {
        $birth = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>NZ Birth Certificate Registration Number</label>
                <input id="nz_birthcertificate" class="form-control" type="number" placeholder="NZ Birth Certificate Registration Number" />
            </div></div>';

        return $birth;
    }
    add_shortcode('cloudcheck_nz_birth_certificate', 'cloudcheck_nz_birth_certificate_shortcode');


	/** Shortcode that shows fields for verification by NZ citizenship:
	 *  certificatenumber, countryofbirth
	 */
    function cloudcheck_nz_citizenship_shortcode($atts = [], $content = null)
    {
        $birth = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>NZ Citizenship Certificate Number</label>
                <input id="nz_citizenshipcertificate" class="form-control" type="number" pattern="^[0-9]{6,10}$" placeholder="NZ Citizenship Certificate Number" />
			</div>
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Country of Birth</label>
                <input id="nz_citizenshipcountryofbirth" class="form-control" type="text" placeholder="Country of Birth" />
            </div></div>';

        return $birth;
    }
    add_shortcode('cloudcheck_nz_citizenship_certificate', 'cloudcheck_nz_citizenship_shortcode');


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

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
                        <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
							<label>Given Name</label>
                            <input id="name" class="form-control" required type="text" placeholder="Given Name" />
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
							<label>Middle Name</label>
                            <input id="middlename" class="form-control"  type="text" placeholder="Middle Name"/>
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
							<label>Family Name</label>
                            <input id="surname" class="form-control" required type="text" placeholder="Family Name"/>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
							<label>Date of birth</label>
                            <input id="dateofbirth" class="form-control" required type="date" placeholder="Date of birth" />
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
							<label>Postcode</label>
                            <input id="postcode" class="form-control" required type="text" placeholder="Postcode" />
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
							<label>City</label>
                            <input id="city" class="form-control" required type="text" placeholder="City"/>
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
							<label>Suburb</label>
                            <input id="suburb" class="form-control" required type="text" placeholder="Suburb"/>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
							<label>Street</label>
                            <input id="street" class="form-control" required type="text" placeholder="Street"/>
                        </div>
                        <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
							<label>Street number</label>
                            <input id="streetnumber" class="form-control" required type="text" placeholder="Street number" />
                        </div>
                    </div>';

        return $info;
    }
    add_shortcode('cloudcheck_basic_info', 'cloudcheck_basic_info_shortcode');


	/** Shortcode that shows email fields:
	 *  Client email, Agent email, Administrator email
	 */
    function cloudcheck_emails_shortcode($atts = [], $content = null)
    {
        $emails = '<div class="row control-group">
                          <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
							  <label>Client email</label>
                              <input id="clientemail" class="form-control" required type="email" placeholder="Client email"/>
                          </div>
                          <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
							  <label>Agent email</label>
                              <input id="agentemail" class="form-control" required type="email" placeholder="Agent email"/>
                          </div>
                          <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
							  <label>Administrator email</label>
                              <input id="adminemail" class="form-control" required type="email" placeholder="Administrator email" />
                          </div>
                    </div>';
        return $emails;
    }
    add_shortcode('cloudcheck_emails', 'cloudcheck_emails_shortcode');


	/** Shortcode that shows fields for verification by NZ passport:
	 *  passport number, passport expiry
	 */
    function cloudcheck_nz_passport_shortcode($atts = [], $content = null)
    {
        $passport = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
                <label>NZ Passport Number</label>
                <input id="nz_passportnumber" class="form-control" type="text" pattern="^[A-Za-z]{2}[0-9]{6}$" title="Passport number can contain exactly 2 letters and 6 digits " placeholder="Passport number" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
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
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
                <label>NZ Driver License Number</label>
                <input id="nz_driverlicensenumber" class="form-control" type="text" pattern="^[A-Za-z]{2}[0-9]{6}$" title="License number can contain exactly 2 letters and 6 digits" placeholder="Driver license number" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
                <label>Driver License Version</label>
                <input id="nz_driverlicenseversion" class="form-control" type="text" pattern="^[0-9]{3}$" title="License version can contain exactly 3 digits" placeholder="Driver license version" />
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
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
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
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
                <label>NZ Birth Certificate Registration Number</label>
                <input id="nz_birthcertificate" class="form-control" type="text" pattern="^[0-9]+$" title="Birth certificate number can contain only digits" placeholder="NZ Birth Certificate Registration Number" />
            </div></div>';

        return $birth;
    }
    add_shortcode('cloudcheck_nz_birth_certificate', 'cloudcheck_nz_birth_certificate_shortcode');


	/** Shortcode that shows fields for verification by NZ citizenship:
	 *  certificatenumber, countryofbirth
	 */
    function cloudcheck_nz_citizenship_shortcode($atts = [], $content = null)
    {
        $citizenship = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
                <label>NZ Citizenship Certificate Number</label>
                <input id="nz_citizenshipcertificate" class="form-control" type="text" pattern="^[0-9]{6,10}$" title="Certificate number can contain not more than 10 digits " placeholder="NZ Citizenship Certificate Number" />
			</div>
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
                <label>Country of Birth</label>
                <input id="nz_citizenshipcountryofbirth" class="form-control" type="text" placeholder="Country of Birth" />
            </div></div>';

        return $citizenship;
    }
    add_shortcode('cloudcheck_nz_citizenship', 'cloudcheck_nz_citizenship_shortcode');


	/** Shortcode that shows fields for verification by Australian passport:
	 *  passport number, passport gender
	 */
    function cloudcheck_au_passport_shortcode($atts = [], $content = null)
    {
        $passport = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
                <label>AU Passport Number</label>
                <input id="au_passportnumber" class="form-control" type="text" pattern="[A-Za-z]{1,2}[0-9]{7}" title="Passport number can contain exactly 1 or 2 letters and 7 digits " placeholder="Passport number" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
                <label>Passport Gender</label>
                <select id="au_passportgender" class="form-control" placeholder="Passport gender">
					<option value="F">Female</option>
					<option value="M">Male</option>
					<option value="X">X</option>
				</select>
            </div></div>';

        return $passport;
    }
    add_shortcode('cloudcheck_au_passport', 'cloudcheck_au_passport_shortcode');


	/** Shortcode that shows fields for verification by Australian citizenship:
	 *  acquisition date, citizenship by descent, stock number
	 */
    function cloudcheck_au_citizenship_shortcode($atts = [], $content = null)
    {
        $citizenship = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
                <input id="au_citizenshipbydescent" class="form-check-input" type="checkbox" value="true" placeholder="AU Citizenship By Descent" />
                <label>AU Citizenship By Descent</label>
			</div>
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
                <label>AU Citizenship Acquisition Date</label>
                <input id="au_citizenshipacquisitiondate" class="form-control" type="date" placeholder="AU Citizenship Acquisition Date" />
			</div>
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
                <label>AU Citizenship Stock Number</label>
                <input id="au_citizenshipstocknumber" class="form-control" type="text" placeholder="AU Citizenship Stock Number" />
            </div></div>';

        return $citizenship;
    }
    add_shortcode('cloudcheck_au_citizenship', 'cloudcheck_au_citizenship_shortcode');


	/** Shortcode that shows fields for verification by Australian driving license:
	 *  state of issue, driving license number
	 */
    function cloudcheck_au_driving_license_shortcode($atts = [], $content = null)
    {
        $driving = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
                <label>AU Driver License Number</label>
                <input id="au_driverlicensenumber" class="form-control" type="text" pattern="[A-Za-z0-9]*" title="License version can contain contain only letters and digits" placeholder="Driver license number" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
                <label>Driver License State of Issue</label>
                <select id="au_driverlicensestate" class="form-control" placeholder="Driver license state of issue" >
					<option value="ACT">ACT</option>
					<option value="NSW">NSW</option>
					<option value="NT">NT</option>
					<option value="QLD">QLD</option>
					<option value="SA">SA</option>
					<option value="TAS">TAS</option>
					<option value="VIC">VIC</option>
					<option value="WA">WA</option>
				</select>
            </div></div>';

        return $driving;
    }
    add_shortcode('cloudcheck_au_driving_license', 'cloudcheck_au_driving_license_shortcode');


	/** Shortcode that shows fields for verification by Australian Visa:
	 *  Country of Issue, Passport Number
	 */
    function cloudcheck_au_visa_shortcode($atts = [], $content = null)
    {
        $visa = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls ml-3">
                <label>AU Visa Country of Issue</label>
                <input id="au_visacountryofissue" class="form-control" type="text" pattern="[A-Za-z]{3}|[Dd]" title="Country code consitst of 3 letters" placeholder="Country of Issue" />
            </div>
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
                <label>AU Visa Passport Number</label>
                <input id="au_visapassportnumber" class="form-control" type="text" pattern="[A-Za-z0-9]*" title="Passport number can contain only letters and digits" placeholder="Passport number" />
            </div></div>';

        return $visa;
    }
    add_shortcode('cloudcheck_au_visa', 'cloudcheck_au_visa_shortcode');


	/** Shortcode that shows fields for verification by Australian ImmiCard:
	 *  immicard number
	 */
    function cloudcheck_au_immicard_shortcode($atts = [], $content = null)
    {
        $immicard = '<div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls mx-3">
                <label>AU ImmiCard Number</label>
                <input id="au_immicardnumber" class="form-control" type="text" pattern="[A-Za-z]{3}[0-9]{6}" title="ImmiCard number can contain 3 letters and 6 digits" placeholder="ImmiCard number" />
            </div></div>';

        return $immicard;
    }
    add_shortcode('cloudcheck_au_immicard', 'cloudcheck_au_immicard_shortcode');

}

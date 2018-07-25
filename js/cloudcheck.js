(function($) {

    $("#cloudcheckForm").submit(function(event) {

        // Prevent spam click and default submit behaviour
        $("#btnSubmit").attr("disabled", true);
        event.preventDefault();

        // get values from FORM
        var name = $("input#name").val();
        var surname = $("input#surname").val();
		var middlename = $("input#middlename").val();
        var dateofbirth = $("input#dateofbirth").val();
        var city = $("input#city").val();
        var suburb = $("input#suburb").val();
        var streetnumber = $("input#streetnumber").val();
        var street = $("input#street").val();
        var postcode = $("input#postcode").val();
        var passportnumber = $("input#passportnumber").val();
        var passportexpiry = $("input#passportexpiry").val();
        var driverlicensenumber = $("input#driverlicensenumber").val();
        var driverlicenseversion = $("input#driverlicenseversion").val();

        var data = { 'details' : {}, 'reference' : '1', 'consent': 'Yes', 'capturereference': 'a09b1dc5-ea4f-4591-9e44-1fca76dfd000' };

        data.details.name = { 'given' : name, 'family': surname };
		if ( middlename ) {
			data.details.name.middle = middlename;
		}
        data.details.dateofbirth = dateofbirth;
        data.details.address = { 'city' : city,
                                 'suburb' : suburb,
                                 'postcode' : postcode,
                                 'streetname' : street,
                                 'streetnumber' : streetnumber
                               };
        if ( passportnumber ) {
            data.details.passport = { 'number' : passportnumber,
    								  'expiry' : passportexpiry
    								};
        };
        if ( driverlicensenumber ) {
            data.details.driverslicence = { 'number' : driverlicensenumber,
    								        'version' : driverlicenseversion
    									  };
        }

        var requestJson = JSON.stringify(data);
        console.log("Cloudcheck request: " + requestJson);

        $.ajax({
            url: "/wp-admin/admin-ajax.php", //"wp-content/plugins/cloudcheck/cloudcheck.php",
            type: "POST",
            dataType: "JSON",
            data: {
                'action': 'cloudcheck_send_request',
                'request': requestJson,
                'path': '/verify/'
            },
            cache: false,
            success: function(data) {
                console.log("Cloudcheck response: " + JSON.stringify(data));
				var ref = data.verification.verificationReference;
				var error = data.verification.errorDetail;
				console.log("Ref: " + ref);
				console.log("Error: " + error);	
				if ( ref ) {
					getPdf(ref);
				} else if ( error ) {
	                // Enable button & show success message
	                $("#btnSubmit").attr("disabled", false);
	                $('#success').html("<div class='alert alert-danger'>");
	                $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
	                    .append("</button>");
	                $('#success > .alert-danger')
	                    .append("<strong>Verification error: </strong>" + error + " <p>" +JSON.stringify(data) + "</p>");
	                $('#success > .alert-danger')
	                    .append('</div>');
				}

                //clear all fields
                $('#cloudcheckForm').trigger("reset");
            },
            error: function() {
                // Fail message
                $('#success').html("<div class='alert alert-danger'>");
                $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                    .append("</button>");
                $('#success > .alert-danger').append("<strong>Sorry " + name + ", it seems that cloudcheck service is not responding. Please try again later!");
                $('#success > .alert-danger').append('</div>');
                //clear all fields
                $('#cloudcheckForm').trigger("reset");
            },
        });
    }); //cloudcheckForm submit


    $("#cloudcheckPdfForm").submit(function(event) {
        // Prevent spam click and default submit behaviour
        $("#btnGetPdf").attr("disabled", true);
        event.preventDefault();

        // get values from FORM
        var reference = $("input#verificationReference").val();
        console.log("Cloudcheck request: " + reference);
		getPdf(reference);
        // Enable button & show success message
        $("#btnGetPdf").attr("disabled", false);
        //clear all fields
        $('#cloudcheckPdfForm').trigger("reset");
    }); //cloudcheckPdfForm submit

	function getPdf(reference) {

        $.ajax({
            url: "/wp-admin/admin-ajax.php", //"wp-content/plugins/cloudcheck/cloudcheck.php",
            type: "POST",
            dataType: "JSON",
            data: {
                'action': 'cloudcheck_send_request',
                'request': reference,
                'path': '/verify/pdf'
            },
            cache: false,
            success: function(data) {
                console.log("Cloudcheck response: " + JSON.stringify(data));
                $('#success').html("<div class='alert alert-success'>");
                $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                    .append("</button>");
                $('#success > .alert-success')
                    .append("<strong>Response from service: </strong>" + JSON.stringify(data));
                $('#success > .alert-success')
                    .append('</div>');

                //open pdf in new tab
                window.open(data.pdf, '_blank');
            },
            error: function() {
                // Fail message
                $('#success').html("<div class='alert alert-danger'>");
                $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                    .append("</button>");
                $('#success > .alert-danger').append("<strong>It seems that Cloudcheck service is not responding. Verification is done, but we are not able to get resulted PDF. Please try again later!");
                $('#success > .alert-danger').append('</div>');
                //clear all fields
                $('#cloudcheckPdfForm').trigger("reset");
            },
        });
	} //getPdf 

}) ( jQuery );

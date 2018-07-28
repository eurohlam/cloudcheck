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
        var clientemail = $("input#clientemail").val();
        var agentemail = $("input#agentemail").val();
        var adminemail = $("input#adminemail").val();

        var emailList = [clientemail, agentemail, adminemail];

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
            url: "/wp-admin/admin-ajax.php",
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
				var errorDetail = data.verification.errorDetail;
                var errorMessage = data.verification.message;
                var errorCode = data.verification.error;
                var errorFields = data.verification.fields;

				console.log("Ref: " + ref);
				console.log("Error: " + errorCode + ": " + errorMessage + ";  " + errorMessage);

				if ( ref ) {
					getPdf(ref, emailList);
                    //clear all fields
                    $('#cloudcheckForm').trigger("reset");
				} else if ( errorCode ) {
	                   showAlert("error", "<p><strong>Verification error " + errorCode + ":</strong></p><p><strong>Error Message:</strong>" + errorMessage
                                + "</p><p><strong>Error Details:</strong> " + errorDetail + "</p>"
                                + "<p><strong>Incorrect fields:</strong> " + errorFields);
				}
                // Enable button
                $("#btnSubmit").attr("disabled", false);

            },
            error: function() {
                // Fail message
                showAlert("error", "<strong>It seems that Cloudcheck service is not responding. Please try again later</strong>");
                // Enable button
                $("#btnSubmit").attr("disabled", false);
            },
        });
    }); //cloudcheckForm submit


	function getPdf(reference, emailList) {
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
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
                showAlert("success", "<strong>Verification completed successfully. Trying to send result by email ...</strong>");

                //open pdf in new tab
                window.open(data.pdfUrl, '_blank');
                //send email
                sendEmail(emailList, data.pdfPath);
            },
            error: function() {
                // Fail message
                showAlert("error", "<strong>It seems that Cloudcheck service is not responding. Verification is done, but we are not able to get resulted PDF. Please try again later!</strong>");
            },
        });
	} //getPdf

    function sendEmail(emailList, filepath) {
        console.log("Sending email to: " + JSON.stringify(emailList));
        console.log("Attachment: " + filepath);
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "POST",
            dataType: "JSON",
            data: {
                'action': 'cloudcheck_send_email',
                'emaillist': emailList,
                'filepath' : filepath
            },
            cache: false,
            success: function(data) {
                console.log("Cloudcheck response: " + JSON.stringify(data));
                showAlert("success", "<strong>Verification completed successfully. Resulted PDF has been sent by email</strong>");
            },
            error: function() {
                // Fail message
                showAlert("error", "<strong>Couldn't send resulted PDF by email. Please, check settings of email server</strong>");
            },
        });
    } //sendEmail

    function showAlert(type, text) {
        if (type == 'error') {
            $('#success').html("<div class='alert alert-danger'>");
            $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>");
            $('#success > .alert-danger').append(text);
            $('#success > .alert-danger').append('</div>');
        } else {
            $('#success').html("<div class='alert alert-success'>");
            $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>");
            $('#success > .alert-success').append(text);
            $('#success > .alert-success').append('</div>');
        }
    } //showAlert

}) ( jQuery );

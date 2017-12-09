     /**************************************** Validations start from here ******************************************/        

// When the browser is ready...
  $(function() {
  
  $.validator.addMethod("loginRegex", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Username must contain only letters, numbers, or dashes."); 
    
      $.validator.addMethod("DateFormat", function(value,element) {
        return value.match(/^(0[1-9]|1[012])[- //\/](0[1-9]|[12][0-9]|3[01])[- //\/](19|20)\d\d$/);
            },"Please enter a date in the format mm/dd/yyyy");
  
      $.validator.addMethod("phoneno", function(value,element) {
        return value.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
            },"Please enter a date in the format mm/dd/yyyy");
  //(/^((\+)?[1-9]{1,2})?([-\s\.])?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}$/);
  
    // Setup form validation on the #register-form element
    $("#agreement-form").validate({
		
     errorPlacement: function(error, element) {
        if ($(element).hasClass("one_required")) {
            error.insertBefore($(element).closest("div"));
        } else {
            error.insertAfter(element);
        }
    },
    
        // Specify the validation rules
        rules: {
           // client_sign:  "required",
           
           date_agg_effective: {
				required: true,
				DateFormat: true,
            },
           
           date_agg_approval: {
				required: true,
				DateFormat: true,
            },
            
           authorized_agent: {
				required: true,
				loginRegex: true,
            },
            
           client_sign:  "required",
           client_address:  "required",
           client_company_name:  "required",
           client_name:  "required",
           client_phone:  "required",
           
           client_email: {
				required: true,
				email: true,
            },
            
              agg_effective_day:  "required",
              agg_agent_name:  "required",
              agg_agent_agency:  "required",
              agg_agent_address:  "required",
              agg_representative:  "required",
              agg_name_title_1:  "required",
              agg_name_title_2:  "required",
            
        },
        
        // Specify the validation error messages
        messages: {
            
			//client_sign: "Please enter your Name",
            
            date_agg_effective:{
                required: "Please Enter Effective Agreement Date",
                DateFormat: "Please Enter valid date in (mm/dd/yyyy) format",
            },
            
            date_agg_approval:{
                required: "Please Enter Approval Date",
                DateFormat: "Please Enter valid date in (mm/dd/yyyy) format",
            },
            
            authorized_agent:{
                required: "Please Enter Authorized Agent",
                loginRegex: "Only Alphabates are Allowed",
            },
            
            client_sign: "Please Enter Signature",
            client_address: "Please Enter Address",
            client_company_name: "Please Enter Company",
            client_name: "Please Enter Name",
            client_phone: "Please Enter Telephone",
            
             client_email:{
                required: "Please Enter Email",
                email: "Please Enter a valid Email",
            },
          
        },
			submitHandler: function(form) {
            form.submit();
        }
    });
    
       
});


			    /********************************Date picker ******************************************/

  $(function() {
    $( ".date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });

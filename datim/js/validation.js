$(document).ready(function(){
			$('.account-behalf').on('change', function() {
			checked_value=$('input[name="account"]:checked').val();
			if(checked_value==1)
			{
				$(".conditional-hide").css("display","block");
				}
			else
				{
					$(".conditional-hide").css("display","none");
				}
			});
        });
        
        
		$(document).ready(function(){
			$('#participating-org').on('change', function() {
			selected_value=$('#participating-org option:selected').val();
			if(selected_value=="Implementing Partner")
			{
				$(".implementing-partner-hide").css("display","block");
				}
			else
				{
					$(".implementing-partner-hide").css("display","none");
				}
			});
        });
        
/**************************************** Validations start from here ******************************************/        

// When the browser is ready...
  $(function() {
  
  $.validator.addMethod("loginRegex", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Username must contain only letters, numbers, or dashes."); 
    
    // Setup form validation on the #register-form element
    $("#registrration-form").validate({
		
     errorPlacement: function(error, element) {
        if ($(element).hasClass("one_required")) {
            error.insertBefore($(element).closest("ul"));
        } else {
            error.insertAfter(element);
        }
    },
    
        // Specify the validation rules
        rules: {
            firstname: {
				required: true,
				loginRegex: true
            },
            
            lastname:  {
				required: true,
				loginRegex: true
            },
            email: {
                required: true,
                email: true
            },
            country: "required",
            participating_org: "required",
            implementing_partner: "required",
            language: "required",
            'data_stream[]': "required",
            'access_type[]': "required",
            acc_full_name: "required",
            acc_email: "required",
            acc_org: "required",
            justification: "required",
        },
        
        // Specify the validation error messages
        messages: {
            
			firstname: {
                required: "Please enter your first name",
                loginRegex: "Only Alphabates are Allowed",
            },

            lastname: {
                required: "Please enter your last name",
                loginRegex: "Only Alphabates are Allowed",
            },
            email: {
                required: "Please provide an email",
                email: "Please enter a valid email address"
            },
            country: "Please select Country",
            participating_org: "Please select Participating Organization",
            implementing_partner: "Please enter Implementing Partner Name",
            language: "Please select Language",
            data_stream: "Please provide Data Stream",
            access_type: "Please provide Access Type",
            acc_full_name: "Please enter Account Requester Fullname",
            acc_email: "Please enter Account Requester Email",
            acc_org: "Please enter Account Requester Organization",
            justification: "Please enter Justification for request",
        },
			submitHandler: function(form) {
            form.submit();
        }
    });

  });
  


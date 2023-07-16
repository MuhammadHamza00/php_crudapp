$(document).ready(function () {
    jQuery("#submit").attr("disabled", true);
    console.log("enter");
    jQuery('#frm').validate({
        rules: {
            f_name: {
                required: true
            },
            l_name: {
                required: true
            },
            u_name: "required",
            country: "required",
            state: "required",
            date: "required",
            p_image: "required",
            c_image: "required",
            age: "required",
            gender: "required",
            confirm:{
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            c_password: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            }
        }, 
        messages: {
            f_name: {
                required: "Please Enter Your First name",
            },
            l_name: {
                required: "Please Enter Your Last name",
            },
            email: {
                required: "Email Required",
                email: "Email Format is Incorrect"
            },
            password: {
                required: "Please Enter Your Email name",
                minlength: "Minimum Length is 8 Characters",
            },
            c_password: {
                required: "Please Enter Your Email name",
                minlength: "Minimum Length is 8 Characters",
                equalTo: "Password Mismatched"
            },
            confirm:{
                required: "Please Check this Box!"
            },
            u_name: "Please Enter Username",
            country: "Please Enter Country Name",
            state: "Please Enter State Name",
            date: "Select Date",
            p_image: "Upload Image",
            c_image: "Upload Id Card Image",
            age: "Age is Required",
            gender: "Select Gender"
        },
        submitHandler: function(form) {
            console.log("I'm in handler");
            jQuery("#submit").attr("disabled", false);
            form.submit();
        }
    });
});

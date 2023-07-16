
$(document).ready(function(){
    $("#ferror").hide();
    // $("#fname").hide();
    let fnameerr = true;
    $("#fname").keyup(function(){
        validatefname();
    });


function validatefname() {
    let fname_value = $("#fname").val();
    if (fname_value.length == "") {
        $("#ferror").show();
        $("#ferror").html("*Cannot be Null!");
        fnameerr = false;
        return false;
    }
    else if(fname_value.length > 15){
        $("#ferror").show();
        $("#ferror").html("*Length must be less than 15");
        fnameerr = false;
        return false;
    }
    else{
        $(".ferror").hide();
    }
}

    $("#lerror").hide();
    let lnameerr = true;
    $("#lname").keyup(function(){
        validatelname();
    });

    function validatelname(){
        let lname_value = $("#lname").val();
        if (lname_value.length == "") {
            $("#lerror").show();
            $("#lerror").html("*Cannot be Null!");
            lnameerr =false;
            return false;
        }
        else if (lname_value.length > 15) {
            $("#lerror").show();
            $("#lerror").html("*Length must ne less than 15");
            lnameerr =false;
            return false;
        }
        else{
            $("#lerror").hide();
        }
    }
    


    $("#perror").hide();
    let pnameerr = true;
    $("#password").keyup(function(){
        validatepassword();
    });

    function validatepassword(){
        let pname_value = $("#password").val();
        if (pname_value.length == "") {
            $("#perror").show();
            $("#perror").html("*Cannot be Null!");
            pnameerr =false;
            return false;
        }
        else if (pname_value.length < 8 || pname_value.length > 15) {
            $("#perror").show();
            $("#perror").html("*Length Must be Between 8 and 15");
            pnameerr =false;
            return false;
        }
        else{
            $("#perror").hide();
        }
    }


    $("#pcerror").hide();
    let pcnameerr = true;
    $("#c_password").keyup(function(){
        validatecpassword();
    });

    function validatecpassword(){
        let pcname_value = $("#c_password").val();
        if (pcname_value.length == "") {
            $("#pcerror").show();
            $("#pcerror").html("*Cannot be Null!");
            pcnameerr =false;
            return false;
        }
        else if (pcname_value != $("#password").val() ) {
            $("#pcerror").show();
            $("#pcerror").html("*Did't Match With Above Password!");
            pcnameerr =false;
            return false;
        }
        else{
            $("#pcerror").hide();
        }
    }

    $("#ageerr").hide();
    let agenameerr = true;
    $("#age").keyup(function(){
        validateagepassword();
    });

    function validateagepassword(){
        let agename_value = $("#age").val();
        if (agename_value.length == "") {
            $("#ageerr").show();
            $("#ageerr").html("*Cannot be Null!");
            agenameerr =false;
            return false;
        }
        else if (agename_value < 18 ) {
            $("#ageerr").show();
            $("#ageerr").html("*Age must be greater than 18");
            agenameerr =false;
            return false;
        }
        else{
            $("#ageerr").hide();
        }
    }

});  
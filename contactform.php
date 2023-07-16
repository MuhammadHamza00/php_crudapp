<?php
include 'config.php';
?>
<!doctype html>
<html lang="en">

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Checkout example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <!-- <link href="form-validation.css" rel="stylesheet"> -->
  </head>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $u_name = $_POST['u_name'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $date = $_POST['date'];

        $c_images = $_FILES['c_image']['name'];
        $p_images = $_FILES['p_image']['name'];
        $target = "uploads/" .basename($p_images);
        $target = "uploads/" .basename($c_images);

        echo $c_images;
        echo $p_images;
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        $sql = "INSERT INTO `register_form` (`id`, `f_name`, `l_name`, `u_name`, `password`, `c_password`, `email`, `country`, `state`, `city`, `join_date`, `p_img`, `c_img`, `age`, `gender`) VALUES ('', '$f_name', '$l_name', '$u_name', '$password', '$c_password', '$email', '$country', '$state', '$city','$date', '$p_images', '$c_images', '$age', '$gender');";

  	    mysqli_query($connect, $sql);

    }
?>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light  sticky-top" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">You Doo!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="crudapp.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactform.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">My Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="display.php">Employees</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Registration Form</h2>
            </div>

            <div class="row g-5">
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Basic Bio-data</h4>
                    <!--Form Start  -->
                    <form method="POST" action=""id="frm" enctype="multipart/form-data">
                        <div class="row g-3">
                        <!-- <span id="ferror">Valid first name is required.</span> -->
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" name ="f_name" id="fname" placeholder="Limit is 15 Characters" value="">
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name<span class="text-muted" id="lerror"></span></label>
                                <input type="text" class="form-control"name="l_name" id="lname" placeholder="Limit is 25 Characters" value="" >
         
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">Username<span class="text-muted" class="errormsg"></span><span class="text-muted">(Only Characters and Numbers Allowed)</span></label>
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control"name="u_name" id="username" placeholder="Username" >
                            
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password<span class="text-muted" id="perror"></span></label>
                                <input type="password" class="form-control"name="password" id="password" placeholder="8 to 12 Characters">
                            
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Confirm Password<span class="text-muted" id="pcerror"></span></label>
                                <input type="password" class="form-control"name="c_password" id="c_password" placeholder="8 to 12 Characters">
                             
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email<span class="text-muted" class="errormsg"></span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                              
                            </div>

                            <div class="col-md-3">
                                <label for="country" class="form-label">Country<span class="text-muted" class="errormsg"></span></label>
                                <input type="text" class="form-control" id="country" name="country"placeholder="" value="" >
                              
                            </div>

                            <div class="col-md-3">
                                <label for="state" class="form-label">State<span class="text-muted" class="errormsg"></span></label>
                                <input type="text" class="form-control" id="state" placeholder=""name="state" value="" >
                              
                            </div>

                            <div class="col-md-3">
                                <label for="City" class="form-label">City<span class="text-muted" class="errormsg"></span></label>
                                <input type="text" class="form-control" id="city" placeholder="" name="city"value="" >
                           
                            </div>

                            <div class="col-md-3">
                                <label for="Date" class="form-label">Joining Date<span class="text-muted" class="errormsg"></span></label>
                                <input type="date" class="form-control" id="jdate" placeholder="31-01-2002"name="date" value="" >
                              
                            </div>

                            <div class="col-md-3">
                                <label for="Date" class="form-label">Personal Image<span class="text-muted" class="errormsg"></span></label>
                                <input type="file" class="form-control" id="pimage" placeholder=""name="p_image" value="" >
                             
                            </div>

                            <div class="col-md-3">
                                <label for="Date" class="form-label">ID Card Image<span class="text-muted" class="errormsg"></span></label>
                                <input type="file" class="form-control" id="cimage" placeholder=""name="c_image" value="" >
                                
                            </div>

                            <div class="col-md-3">
                                <label for="age" class="form-label">Age<span class="text-muted" id="ageerr"></span></label>
                                <input type="number" class="form-control" id="age" placeholder="In Years"name="age" >
                            
                            </div>

                            <div class="col-md-3">
                                <label for="country" class="form-label">Gender<span class="text-muted" class="errormsg"></span></label>
                                <select class="form-select" id="gender"name="gender" >
                                    <option >Male</option>
                                    <option>Female</option>
                                </select>
                            
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="confirm"id="exampleCheck1" >
                                <label class="form-check-label" for="exampleCheck1">*I agree with terms and conditions</label>
                            </div>
                        </div>

                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit"name="submit"id="submit">Register Now</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017–2021 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
    // jQuery("#submit").attr("disabled", true);
    // console.log("enter");
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

</script>
</body>

</html>
<?php

mysqli_close($connect);
?>
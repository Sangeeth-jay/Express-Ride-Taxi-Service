<?php
session_start();
include 'db/db_config.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Express Ride</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/customerRegister.css">
    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <form action="addcustomerdetails.php" id="customer-registration" method="post">
        <div class="main">

            <h1 class="text-center" style="color: rgb(0, 0, 0); font-weight: bold; font-family: Roboto Serif;">
                Express<span style="color: #fff; font-family: Roboto Serif; font-weight: bold;">Ride</span></h1>
            <div class="conatiner">
                <div id="cus_alert-text">

                </div>
                <div class="row">
                    <div class="fname col-lg-6 col-md-6 col-12">
                        <label for="" class="form-label">First Name</label>
                        <input type="text" name="cus_f_name" id="cus_f_name" placeholder="enter your first name" class="form-control" required>
                    </div>
                    <div class="lname col-lg-6 col-md-6 col-12">
                        <label for="" class="form-label">Last Name</label>
                        <input type="text" name="cus_l_name" id="cus_l_name" placeholder="enter your last name" class="form-control" required>
                    </div>
                    <div class="email col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Email</label>
                        <input type="text" name="cus_email" placeholder="enter your email" id="cus_email" class="form-control" required>
                    </div>
                    <div class="telephone col-lg-6 col-md-6 col-12">
                        <label for="" class="form-label">Telephone</label>
                        <input type="text" name="cus_telephone" id="cus_telephone" placeholder="enter your telephone" class="form-control" required>
                    </div>
                    <div class="NIC col-lg-6 col-md-6 col-12">
                        <label for="" class="form-label">NIC</label>
                        <input type="text" name="cus_nic" id="cus_nic" placeholder="enter your NIC" class="form-control" required>
                    </div>
                    <div class="password col-lg-6 col-md-6 col-12">
                        <label for="" class="form-label">Password</label>
                        <input type="text" name="cus_password" id="cus_password" placeholder="enter your password" class="form-control" required>
                    </div>
                    <div class="re-enter-password col-lg-6 col-md-6 col-12">
                        <label for="" class="form-label">Re-Enter Password</label>
                        <input type="text" name="cus_re-enter_password" id="cus_re-enter_password" placeholder="Re-enter password" class="form-control" required>
                    </div>

                    <center><button type="submit" class="btn btn-light mt-2" id="create-account">Create an Account</button></center>
                    <center>
                        <p><label class="form-check-label" for="exampleCheck1">Have an
                                Account ? </label>
                            <a href="customerLogin.php" class="form-newAccount">Login</a>
                        </p>
                    </center>

                </div>


            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#create-account").click(function() {
                var fname = document.getElementById('cus_f_name').value;
                var lname = document.getElementById('cus_l_name').value;
                var email = document.getElementById('cus_email').value;
                var telephone = document.getElementById('cus_telephone').value;
                var nic = document.getElementById('cus_nic').value;
                var password = document.getElementById('cus_password').value;
                var reenterpassword = document.getElementById('cus_re-enter_password').value;

                if (fname == "" || lname == "" || email == "" || telephone == "" || nic == "" || password == "" || reenterpassword == "") {
                    alert("error");

                }
                // if (password == reenterpassword) {

                //     $.post($("#customer-registration").attr("action"),
                //         $("#customer-registration :input").serializeArray(),
                //         function(info) {
                //             $("#cus_alert-text").empty();
                //             $("#cus_alert-text").html(info);
                //         });
                //     // $(".form-control").vl('');
                //     $("#customer-registration").submit(function() {
                //         return false;
                //     });
                //     window.setTimeout(function() {
                //         $("#cus_alert-text").alert('close');
                //     }, 2000);
                // } else {
                //     alert('Password is Not Equal');

                //     // var result = document.getElementById('result').value;
                //     // document.getElementById('cus_alert-text').innerHTML = result;
                // }
            });
        });
    </script>
</body>

</html>
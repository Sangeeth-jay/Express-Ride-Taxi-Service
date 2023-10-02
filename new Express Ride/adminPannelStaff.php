<?php
session_start();
include 'db/db_config.php';

if ($_SESSION['designation'] > 1) {
    header('location:staffLogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/adminPannel.css">
    <link rel="stylesheet" href="css/adminPannelStaff.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


</head>

<body>
    <input type="hidden" id="designation" name="designation" <?php echo 'value="' . $_SESSION['designation'] . '"' ?>>
    <nav class="navbar" style="background: rgba(253, 226, 139, 0.224);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h2>Express<span style="color: #FFC300;">Ride</span></h2>
            </a>
            <h6 style="color: #949391; font-weight: 300; margin-right: 1em;" class="ms-auto">Wellcome, <?php echo $_SESSION['uName'] ?></h6>
            <img src="img/icons8-user-48.png" alt="">
            <div class="menu-toggle d-lg-none ">
                <div class="hamburger">
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <!-- side bar -->

    <div class="app">
        <aside class="sidebar">


            <nav class="menu">

                <a href="adminPannel.php" class="menu-item" id="tab1"> <img src="img/icons8-booking-67.png" width="15%" alt="" style="margin-right: 1.5em;">Bookings</a>
                <a href="adminPannelHistory.php" class="menu-item" id="tab2"> <img src="img/icons8-history-96.png" width="15%" alt="" style="margin-right: 1.5em;">History</a>
                <a href="adminPannelStaff.php" class="menu-item is-active" id="tab3"> <img src="img/icons8-users-64.png" width="15%" alt="" style="margin-right: 1.5em;">Add Staff</a>
                <a href="adminPannelVehicle.php" class="menu-item" id="tab6"> <img src="img/icons8-bus-50.png" width="15%" alt="" style="margin-right: 1.5em;">Vehicle</a>
                <a href="adminPannelFeedback.php" class="menu-item" id="tab4"> <img src="img/icons8-feedback-50.png" width="15%" alt="" style="margin-right: 1.5em;">Feedbacks</a>
                <a href="adminPannelNews.php" class="menu-item" id="tab5"> <img src="img/icons8-news-24.png" width="15%" alt="" style="margin-right: 1.5em;">News</a>

                <center>
                    <form action="logOut.php">
                        <button class="btn btn-warning text-light" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); font-weight: 600;">Log Out</button>
                    </form>
                </center>

            </nav>

        </aside>

        <div id="result"></div>
        <main class="content">
            <section id="tab-staff" class="tab-staff">
                <div class="news ">
                    <?php
                    $sqlShowNews = "SELECT * FROM news;";
                    $resultShowNews = mysqli_query($conn, $sqlShowNews);

                    if (mysqli_num_rows($resultShowNews) > 0) {
                        while ($row = mysqli_fetch_assoc($resultShowNews)) {
                            $news = $row['description'];
                    ?>
                            <h3><?php echo $news ?></h3>
                    <?php
                        }
                    }
                    ?>

                </div>

                <div id="alert-text"> </div>

                <ul class="nav nav-tabs justify-content-center mt-5" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Add Staff</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Update Staff</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="conatiner">
                            <form action="addstaff.php" method="post" id="add_staff">
                                <div class="row">
                                    <div class="fname col-lg-8 col-md-8 col-12">
                                        <label for="" class="form-label mt-3">Full Name</label>
                                        <input type="text" name="f_name" id="f_name" placeholder="enter your full name" class="form-control" required>
                                    </div>
                                    <div class="lname col-lg-4 col-md-4 col-12">
                                        <label for="" class="form-label mt-3">User Name</label>
                                        <input type="text" name="u_name" id="u_name" placeholder="enter user name" class="form-control" required>
                                    </div>
                                    <div class="telephone col-lg-6 col-md-6 col-12">
                                        <label for="" class="form-label mt-3">Telephone</label>
                                        <input type="text" name="telephone" id="telephone" placeholder="enter your telephone" class="form-control" required>
                                    </div>
                                    <div class="NIC col-lg-6 col-md-6 col-12">
                                        <label for="" class="form-label mt-3">NIC</label>
                                        <input type="text" name="NIC" id="NIC" placeholder="enter your NIC" class="form-control" required>
                                    </div>
                                    <div class="password col-lg-8 col-md-8 col-12">
                                        <label for="" class="form-label mt-3">Password</label>
                                        <input type="text" name="password" id="password" placeholder="enter your password" class="form-control" required>
                                    </div>
                                    <div class="designation col-lg-4 col-md-4 col-12">
                                        <label for="" class="form-label mt-3">Designation</label>
                                        <select name="designation" id="designation" class="form-control" required>
                                            <option value="0">Select</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Reservation Manager</option>
                                            <option value="3">Driver</option>
                                        </select>
                                    </div>

                                    <center><button type="submit" id="addstaff" class="btn btn-light yellow mt-4">+ Add</button></center>

                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="conatiner mt-3">
                            <div class="row">
                                <form action="" method="get">
                                    <div class="NIC col-lg-6 col-md-6 col-12">
                                        <label for="" class="form-label">NIC</label>
                                        <input type="text" name="nic" id="nic" placeholder="enter your NIC" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <center><button type="button" name="" class="btn btn-light yellow mt-4" id="staff-search">Search</button>
                                        </center>
                                    </div>
                                </form>
                                <div class="content-search">
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="js/adminPannel.js"></script>
<script>
    const menu_toggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menu_toggle.addEventListener('click', () => {
        menu_toggle.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
    });

    // authentication

    let designation = document.getElementById('designation').value;

    if (designation == 2) {
        $("#tab3").addClass("disabled");
        $("#tab6").addClass("disabled");

    }
</script>
<script>
    // add staff
    $(document).ready(function() {
        $("#addstaff").click(function() {

            var fname = document.getElementById('f_name').value;
            var uname = document.getElementById('u_name').value;
            var telephone = document.getElementById('telephone').value;
            var nic = document.getElementById('NIC').value;
            var password = document.getElementById('password').value;
            var designation = document.getElementById('designation').value;

            if (fname == "" || uname == "" || telephone == "" || nic == "" || password == "" || designation == "") {
                alert("Field is Empty!");
            } else {
                $.post($("#add_staff").attr("action"),
                    $("#add_staff :input").serializeArray(),
                    function(info) {
                        $("#alert-text").empty();
                        $("#alert-text").html(info);
                    });
                $('.form-control').val('');
                window.setTimeout(function() {
                    $("#alert-text").alert('close');
                }, 2000);
                $("#add_staff").submit(function() {
                    return false;
                });
            }
        });
    });
</script>
<script>
    // search members
    $("#staff-search").click(function() {
        var nic = document.getElementById("nic").value;
        if (nic == "") {
            alert("Insert the ID");
        } else {
            $('.content-search').load('searchStaffMember.php?nic=' + nic);
        }
    });
</script>

</html>
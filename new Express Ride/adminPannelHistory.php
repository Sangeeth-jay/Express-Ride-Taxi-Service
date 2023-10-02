<?php
session_start();
include 'db/db_config.php';

if ($_SESSION['designation'] > 2) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <style>
        thead {
            background-color: #FFC300;
        }
    </style>

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
                <a href="adminPannelHistory.php" class="menu-item is-active" id="tab2"> <img src="img/icons8-history-96.png" width="15%" alt="" style="margin-right: 1.5em;">History</a>
                <a href="adminPannelStaff.php" class="menu-item " id="tab3"> <img src="img/icons8-users-64.png" width="15%" alt="" style="margin-right: 1.5em;">Add Staff</a>
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
            <section id="tab-booking" class="tab-booking">
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

                <div class="text" id="details-text"> </div>

                <center>
                    <h1 style="margin-top: 1em;">Booking History</h1>

                    <form action="searchHistory.php" method="post" id="searchHistory">
                        <div class="input-group mb-3" style="width: 12em; z-index: 1;">
                            <input type="text" id="booking_id" class="form-control" placeholder="Booking ID" aria-label="Recipient's username" aria-describedby="button-addon2" name="bookingId">
                            <button class="btn btn-warning text-light" type="submit" id="history_search">Search</button>
                        </div>
                    </form>

                </center>

                <div class="table-div">
                    <div class="table-responsive" id="table-responsive">

                    </div>
                </div>


            </section>
        </main>
    </div>
</body>
<script>
    // authentication

    let designation = document.getElementById('designation').value;

    if (designation == 2) {
        $("#tab3").addClass("disabled");
        $("#tab6").addClass("disabled");

    }
</script>

<script>
    const menu_toggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menu_toggle.addEventListener('click', () => {
        menu_toggle.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
    });

    // detail booking button load 
    $(document).ready(function() {

        $("#history_search").click(function() {
            $.post($("#searchHistory").attr("action"),
                $("#searchHistory :input").serializeArray(),
                function(info) {
                    $("#table-responsive").empty();
                    $("#table-responsive").html(info);
                });
            $("#searchHistory").submit(function() {
                return false;
            });

        });
    });
</script>

</html>
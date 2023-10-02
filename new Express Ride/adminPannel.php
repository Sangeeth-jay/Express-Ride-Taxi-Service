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

                <a href="#" class="menu-item is-active" id="tab1"> <img src="img/icons8-booking-67.png" width="15%" alt="" style="margin-right: 1.5em;">Bookings</a>
                <a href="adminPannelHistory.php" class="menu-item" id="tab2"> <img src="img/icons8-history-96.png" width="15%" alt="" style="margin-right: 1.5em;">History</a>
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

                <div class="text" id="details-text">

                </div>



                <h3 style="margin-top: 1.5em; margin-bottom: 1em; margin-left: 1.5em; color: #3c3f58; font-weight: bold;">
                    Bookings for Acceptation</h3>

                <?php

                $sqlBooking = "SELECT * FROM booking WHERE acceptation = 'waiting';";
                $resultBooking = mysqli_query($conn, $sqlBooking);

                if (mysqli_num_rows($resultBooking) > 0) {
                    while ($row = mysqli_fetch_assoc($resultBooking)) {
                        $bookingId = $row['booking_id'];
                        $pickUp = $row['pickup_point'];
                        $destination = $row['destination'];
                        $date = $row['date'];
                        $time = $row['time'];


                ?>

                        <div class="booking-div">
                            <div class="booking-brief">
                                <center>
                                    <table style="margin-top: 2em;">
                                        <input type="hidden" name="hidden-booking-id" id="hidden-booking-id" value="<?php echo $bookingId ?>">

                                        <tr>
                                            <th scope="col" style="text-decoration: underline;">Booking ID</th>
                                            <th scope="col" style="text-decoration: underline;">Pick-up Point</th>
                                            <th scope="col" style="text-decoration: underline;">Destination</th>
                                            <th scope="col"><?php echo $date ?></th>
                                            <th scope="col" rowspan="2">
                                                <form action="showBookingDetailed.php" method="post" id="showDetailed">
                                                    <input type="hidden" name="hidden-booking-id" id="hidden-booking-id" value="<?php echo $bookingId ?>">

                                                    <button type="submit" class="btn-details" id="btn-details" style="background-color: #FFC300; color: #fff; width: 8em;height: 5em; border-radius: 10px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Details</button>
                                                </form>
                                            </th>
                                            <th scope="col">
                                                <form action="bookingAccept.php" method="get" id="accept-form">
                                                    <input type="hidden" name="date" id="date">
                                                    <input type="hidden" name="time" id="time">
                                                    <input type="hidden" name="bookingId" value="<?php echo $bookingId ?>">
                                                    <button id="accept" style="background-color: #29BF12;color: #fff; width: 8em;height: 2em; border-radius: 10px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Accept</button>
                                                </form>
                                            </th>

                                        </tr>
                                        <tr>
                                            <td data-label="Booking ID"><?php echo $bookingId ?></td>
                                            <td data-label="Pick-up Point"><?php echo $pickUp ?></td>
                                            <td data-label="Destination"><?php echo $destination ?></td>
                                            <td data-label="<?php echo $date ?>"><?php echo $time ?></td>
                                            <td style="text-align: center;" class="d-lg-none ">
                                                <button type="submit" class="btn-details" style="background-color: #FFC300;color: #fff; width: 8em;height: 2em; border-radius: 10px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Details</button>
                                            </td>
                                            <td style="text-align: center; " class="d-lg-none ">
                                                <form action="bookingAccept.php" method="get" id="accept-form">
                                                    <input type="hidden" name="date" id="date2">
                                                    <input type="hidden" name="time" id="time2">
                                                    <input type="hidden" name="bookingId" value="<?php echo $bookingId ?>">
                                                    <button id="accept" style="background-color: #29BF12;color: #fff; width: 8em;height: 2em; border-radius: 10px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Accept</button>
                                                </form>
                                            </td>
                                            <td style="text-align: center; ">
                                                <form action="notAccepted.php" method="get" id="not-accept-form">
                                                    <input type="hidden" name="date" id="date3">
                                                    <input type="hidden" name="time" id="time3">
                                                    <input type="hidden" name="bookingId" value="<?php echo $bookingId ?>">
                                                    <button id="not-accept" style="background-color: #EF6461; color: #fff; width: 8em;height: 2em; border-radius: 10px; border: none; margin-top: -1em; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Not-Accept</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>

                                </center>


                            </div>



                    <?php
                    }
                }

                    ?>
                        </div>

                        <div class="detailed-booking container" id="detailed-booking">

                        </div>

            </section>
        </main>
    </div>


</body>
<script>
    const menu_toggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menu_toggle.addEventListener('click', () => {
        menu_toggle.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
    });


    // date & time
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    hh = n.getHours();
    mm = n.getMinutes();
    ss = n.getSeconds();

    document.getElementById("date").value = y + "-" + m + "-" + d;
    document.getElementById("time").value = hh + ":" + mm + ":" + ss;

    document.getElementById("date2").value = y + "-" + m + "-" + d;
    document.getElementById("time2").value = hh + ":" + mm + ":" + ss;

    document.getElementById("date3").value = y + "-" + m + "-" + d;
    document.getElementById("time3").value = hh + ":" + mm + ":" + ss;

    // authentication

    let designation = document.getElementById('designation').value;

    if (designation == 2) {
        $("#tab3").addClass("disabled");
        $("#tab6").addClass("disabled");

    }
</script>

</html>
<?php
session_start();
include 'db/db_config.php';

$uId = $_SESSION['uId'];
$currentBooking;
$currentStatus;

$sqlBookingId = "SELECT * FROM booking where user_id = '$uId' and acceptation = 'accepted';";
$resultId = mysqli_query($conn, $sqlBookingId);

if (mysqli_num_rows($resultId) > 0) {
    while ($row = mysqli_fetch_assoc($resultId)) {
        $currentBooking = $row['booking_id'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver DashBoard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/driverDashboard.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <style>
        .disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        #waiting {
            color: #fff;
            visibility: hidden;
        }

        #bookingdetails-btn {
            position: absolute;
            color: #fff;
            background-color: #ffc300;
            width: 40%;
            top: 29%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 25px;
        }

        .detailed-booking {
            visibility: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50%;
            transform: translate(-50%, -50%);
            padding: 1em;
            color: #949391;
            padding-left: 2em;
            padding-right: 2em;
            height: auto;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.25);
        }

        .detailed-booking label {
            font-size: 18px;
            font-weight: 700;
        }

        .upcomming {
            height: 70vh;
            overflow-y: scroll;
        }

        .conatiner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffc300;
            width: 40%;
            height: auto;
            margin: 7% auto;
            padding: 65px 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .btn-light {
            background-color: #fff;
            color: #292626;
            width: 100%;
            font-family: Roboto Serif;
            font-size: 25px;
            font-weight: bold;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .text-center {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
        }

        @media screen and (max-width: 768px) {
            .conatiner {
                position: absolute;
                top: 55%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                height: auto;
                margin: 7% auto;
                padding: 65px 40px;
            }

            #bookingdetails-btn {
                width: 90%;
            }
            .detailed-booking {
                width: 90%;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar" style="background: rgba(253, 226, 139, 0.224);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h2>Express<span style="color: #FFC300;">Ride</span></h2>
            </a>
            <h6 style="color: #949391; font-weight: 300; margin-right: 1em;" class="ms-auto">Wellcome, <?php echo $_SESSION['uName'] ?></h6>
            <form action="logOut.php">
                <button class="btn btn-warning text-light" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); font-weight: 600;">Log Out</button>
            </form>
            <div class="menu-toggle d-lg-none ">
                <div class="hamburger">
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <h1 class="text-center" style="color: rgb(0, 0, 0); font-weight: bold; font-family: Roboto Serif;">
        Express<span style="color: #FFC300; font-family: Roboto Serif; font-weight: bold;">Ride</span></h1>


    <div class="main">

        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Current Ride</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Upcomming</button>
            </li> -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">History</button>
            </li>
        </ul>
        <div class="opa"></div>
        <div class="tab-content" id="myTabContent">

            <?php

            if (isset($currentBooking)) {
                $sqlFindStatus = "SELECT * FROM booking_status where booking_booking_id = '$currentBooking' order by date asc, time desc limit 1; ";
                $resultFindStatus = mysqli_query($conn, $sqlFindStatus);

                if (mysqli_num_rows($resultFindStatus) > 0) {
                    while ($row = mysqli_fetch_assoc($resultFindStatus)) {
                        $currentStatus = $row['status'];
                    }
                }
            }
            ?>

            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <center><button type="submit" class="btn btn-light" id="bookingdetails-btn">Booking Details</button></center>
                <div class="conatiner">
                    <input type="hidden" name="" value="<?php echo $currentStatus ?> " id="status">
                    <center>
                        <form action="pickupConfirm.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $currentBooking ?> ">
                            <input type="hidden" name="date" id="date1">
                            <input type="hidden" name="time" id="time1">
                            <button type="submit" class="btn btn-light" id="pickupBtn">Pick up the Customer</button>
                        </form>
                    </center>
                    <center>
                        <form action="reachedConfirm.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $currentBooking ?> ">
                            <input type="hidden" name="date" id="date2">
                            <input type="hidden" name="time" id="time2">
                            <button type="submit" class="btn btn-light  mt-5" id="reachBtn">Reach out of Designation</button>
                        </form>
                    </center>
                    <center>
                        <form action="completeConfirm.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $currentBooking ?> ">
                            <input type="hidden" name="date" id="date3">
                            <input type="hidden" name="time" id="time3">
                            <button type="submit" class="btn btn-light mt-5" id="completeBtn">Complete the Booking</button>
                        </form>
                    </center>
                    <center>
                        <h3 id="waiting">Waiting for Payment</h3>
                    </center>
                </div>

            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                <?php
                // $sql = "SELECT * FROM expressride.booking where user_id = '$uId';";
                ?>

                <!-- <div class="upcomming">
                    <?php
                    // $sqlUpcomming = "SELECT * FROM booking where user_id = '$uId' and acceptation = 'accepted';";
                    // $resultUpcoming = mysqli_query($conn, $sqlUpcomming);

                    // if (mysqli_num_rows($resultUpcoming) > 0) {
                    //     while ($row = mysqli_fetch_assoc($resultUpcoming)) {
                    //         $bookingId = $row['booking_id'];
                    //         $pickUp = $row['pickup_point'];
                    //         $destination = $row['destination'];
                    //         $date = $row['date'];
                    //         $time = $row['time'];
                    ?>

                            <center>
                                <table style="margin-top: 2em;">

                                     <thead> -->
                <!-- <tr>
                                        <th scope="col" style="text-decoration: underline;">Booking ID</th>
                                        <th scope="col" style="text-decoration: underline;">Pick-up Point</th>
                                        <th scope="col" style="text-decoration: underline;">Destination</th>
                                        <th scope="col"><?php echo $date ?></th>

                                    </tr> -->
                <!-- </thead>
                            <tbody> -->
                <!-- <tr>
                                        <td data-label="Booking ID"><?php echo $bookingId ?></td>
                                        <td data-label="Pick-up Point"><?php echo $pickUp ?></td>
                                        <td data-label="Destination"><?php echo $destination ?></td>
                                        <td data-label="<?php echo $date ?>"><?php echo $time ?></td>
                                    </tr> -->
                <!-- </tbody> -->
                <!-- </table> -->
                <!-- </center> -->

                <?php
                //     }
                // }
                ?>

                <!-- </div> -->

            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">

                <center>
                    <div class="history">
                        <div class="table-div">
                            <div class="table-responsive ">
                                <table class="table table-warning" style="width:70vw;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10%;">ID</th>
                                            <th scope="col" style="width: 25%;">Pick-up Point</th>
                                            <th scope="col" style="width: 25%;">Destination</th>
                                            <th scope="col" style="width: 15%;">Vehicle</th>
                                            <th scope="col" style="width: 15%;">Amount</th>
                                            <th scope="col" style="width: 10%;">Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db/db_config.php';
                                        // $userID = $_REQUEST['uId'];
                                        $i = 0;

                                        $sql = "SELECT b.*, v.type FROM booking b join vehicle v on b.vehicle_id = v.vehicle_id where user_id = '$uId' and acceptation = 'completed';";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $i++;

                                                $id = $row['user_id'];
                                                $pickUp = $row['pickup_point'];
                                                $destination = $row['destination'];
                                                $vehicle = $row['type'];
                                                $amount = $row['amount'];
                                                $status = $row['acceptation'];

                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $uId ?></th>
                                                    <td><?php echo $pickUp ?></td>
                                                    <td><?php echo $destination ?></td>
                                                    <td><?php echo $vehicle ?></td>
                                                    <td><?php echo $amount ?></td>
                                                    <td><?php echo $status ?></td>

                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </center>

            </div>
        </div>


    </div>

    <!-- details -->

    <input type="hidden" id="customerId" name="customer-id">
    <input type="hidden" id="BookingId" name="Booking-id">
    <?php

    if (isset($currentBooking)) {
        $sqlBookingDetails = "select b.booking_id, b.pickup_point, b.destination, b.km, b.date, b.time, c.first_name, c.telephone, v.type from booking b inner join customer c on  b.customer_id=c.customer_id inner join vehicle v on v.vehicle_id=b.vehicle_id where booking_id = '$currentBooking';";
        $resultBookingDetails = mysqli_query($conn, $sqlBookingDetails);

        if (mysqli_num_rows($resultBookingDetails) > 0) {
            while ($row = mysqli_fetch_assoc($resultBookingDetails)) {
                $pickUp = $row['pickup_point'];
                $destination = $row['destination'];
                $distance = $row['km'];
                $date = $row['date'];
                $time = $row['time'];
                $bookingId = $row['booking_id'];
                $customername = $row['first_name'];
                $telephone = $row['telephone'];
                $vehicle = $row['type'];
            }
        }
    }

    if(isset($currentBooking)) {
    ?>


    <div class="popup col-lg-7 col-md-12 col-12 " id="popup">
        <div class="col-lg-7 col-md-12 col-12 ">
            <div class="progress-bar-div detailed-booking ">
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">Customer Name</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $customername ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">Telephone</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $telephone ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">Booking Id</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $bookingId ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">Pick up Point</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $pickUp ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">destination</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $destination ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">Distance</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $distance ?> km</div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">Date</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $date ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">Time</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $time ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6"><label for="">Vehicle</label></div>
                    <div class="col-lg-6 col-6 text-end"><?php echo $vehicle ?></div>
                </div>
                <center><button type="button" id="details-button-close" class="btn btn-light mt-3" style="width: 50%; background-color: #ffc300; color: #FFF; font-size: 18px;">Done</button></center>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $("#bookingdetails-btn").click(function() {
            $(".detailed-booking").css("visibility", "visible");
        });
        $("#details-button-close").click(function() {
            $(".detailed-booking").css("visibility", "hidden");
        });
    });
</script>

<script>
    var status = document.getElementById('status').value;
    console.log(status);

    $(document).ready(function() {
        if (status == "accepted ") {
            $("#reachBtn").addClass("disabled");
            $("#completeBtn").addClass("disabled");
        } else if (status == "pickedUp ") {
            $("#pickupBtn").addClass("disabled");
            $("#reachBtn").removeClass("disabled");
            $("#completeBtn").addClass("disabled");
        } else if (status == "reached ") {
            $("#waiting").css("visibility", "visible");
            $("#pickupBtn").addClass("disabled");
            $("#reachBtn").addClass("disabled");
            $("#completeBtn").addClass("disabled");
        } else if (status == "payed ") {
            $("#waiting").css("visibility", "hidden");
            $("#pickupBtn").addClass("disabled");
            $("#reachBtn").addClass("disabled");
            $("#completeBtn").removeClass("disabled");
        } else {
            $("#waiting").css("visibility", "hidden");
            $("#pickupBtn").addClass("disabled");
            $("#reachBtn").addClass("disabled");
            $("#completeBtn").addClass("disabled");
        }
    });
</script>

<script>
    // date & time
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    hh = n.getHours();
    mm = n.getMinutes();
    ss = n.getSeconds();

    document.getElementById("date1").value = y + "-" + m + "-" + d;
    document.getElementById("time1").value = hh + ":" + mm + ":" + ss;

    document.getElementById("date2").value = y + "-" + m + "-" + d;
    document.getElementById("time2").value = hh + ":" + mm + ":" + ss;

    document.getElementById("date3").value = y + "-" + m + "-" + d;
    document.getElementById("time3").value = hh + ":" + mm + ":" + ss;
</script>

</html>
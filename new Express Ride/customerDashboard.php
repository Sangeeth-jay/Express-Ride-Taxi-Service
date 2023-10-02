<?php
session_start();
include 'db/db_config.php';

$f_name = $_SESSION['f_name'];
$customer_id = $_SESSION['customer_id'];
$bookingIdTemp = '';
$bookingId;
$acceptation;
$currentStatus;

$sqlFindBookings = " SELECT * FROM booking WHERE customer_id = '$customer_id' order by date desc, time desc limit 1;  ";
$resultFindBookings = mysqli_query($conn, $sqlFindBookings);

if (mysqli_num_rows($resultFindBookings) > 0) {
    while ($row = mysqli_fetch_assoc($resultFindBookings)) {
        $bookingIdTemp = $row['booking_id'];
        $acceptationTemp = $row['acceptation'];
    }
}


if ($bookingIdTemp != '') {
    $bookingId = $bookingIdTemp;
    $acceptation = $acceptationTemp;
} else {
    $bookingId = '0';
    $acceptation = 'empty';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/customerDashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <style>
        .container-payment {
            visibility: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20%;
            height: auto;
            padding: 1.5em;
            background-color: #FFC300;
            border-radius: 15px;
        }

        /* .form-control {
            width: 80%;
            height: 10em;
            font-size: 25PX;
            font-family: Roboto Serif;
        } */

        .pay-btn {
            width: 50%;
            height: 2em;
            color: #FFC300;
            font-family: Roboto Serif;
            font-size: 25px;
        }

        @media screen and (max-width:800px) {
            .pay-btn {
                width: 60%;
            }

            .container-payment {
                width: 40%;
            }

        }

        @media screen and (max-width:500px) {
            .pay-btn {
                width: 60%;
            }

            .container-payment {
                width: 70%;
            }
        }

        .opa {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: rgb(14, 14, 14);
            opacity: 30%;
            visibility: hidden;
        }
    </style>

</head>

<body>

    <input type="hidden" id="booking-acceptation" name="booking-acceptation" <?php echo 'value="' . $acceptation . '"' ?>>
    <div class="opa"></div>
    <nav class="navbar" style="background: rgba(253, 226, 139, 0.224);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h2>Express<span style="color: #FFC300;">Ride</span></h2>
            </a>
            <h6 style="color: #949391; font-weight: 300; margin-right: 1em;" class="ms-auto">Wellcome, <?php echo $f_name ?></h6>
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
                <center><button class="btn book-now" id="book-now" style="width: 15em; font-weight: bold; height: 3em; border-radius: 15px; background: #FFC300; color: #fff; margin-bottom: 2em;">+
                        Book Now</button></center>
                <a href="#" class="menu-item is-active" id="tab1"> <img src="img/home.png" width="15%" alt="" style="margin-right: 1.5em;">Dashboard</a>
                <a href="customerDashboardHistory.php?bookingId=<?php echo $bookingId ?>" class="menu-item" id="tab2"> <img src="img/icons8-history-96.png" width="15%" alt="" style="margin-right: 1.5em;">History</a>
                <a href="customerDashboardFeedback.php?bookingId=<?php echo $bookingId ?>" class="menu-item" id="tab3"> <img src="img/icons8-feedback-50.png" width="15%" alt="" style="margin-right: 1.5em;">Feedbacks</a>
                <center>
                    <form action="logOut.php">
                        <button class="btn logout" style="width: 8em; font-weight: bold; height: 3em; border-radius: 10px; background: #FFC300; color: #fff; margin-bottom: 2em;">
                            Log Out</button>
                    </form>
                </center>
            </nav>

        </aside>

        <main class="content">

            <section id="tab-dashboard" class="tab-dashboard">


                <div class="news " style="background-color: #d3d3d28e;height: 7vh; padding: 0.5em;">
                    <marquee behavior="" direction="">News on going</marquee>
                </div>

                <div id="result">

                </div>

                <?php
                if ($acceptation == "empty" || $acceptation == "canceled" || $acceptation == "completed") {
                ?>
                    <center>
                        <h1>0 Bookings</h1>
                    </center>
                <?php
                } else {

                    $sqlBookingDetails = "select b.pickup_point, b.destination, b.km, b.amount, b.date, b.time, b.user_id, v.type, v.vehicle_id, u.full_name from booking b join vehicle v on b.vehicle_id=v.vehicle_id join user u on b.user_id=u.user_id where booking_id = '$bookingId';   ";
                    $resultBookingDetails = mysqli_query($conn, $sqlBookingDetails);

                    if (mysqli_num_rows($resultBookingDetails) > 0) {
                        while ($row = mysqli_fetch_assoc($resultBookingDetails)) {
                            $pickUp = $row['pickup_point'];
                            $destination = $row['destination'];
                            $distance = $row['km'];
                            $amount = $row['amount'];
                            $date = $row['date'];
                            $time = $row['time'];
                            $driverId = $row['user_id'];
                            $driver = $row['full_name'];
                            $vehicle = $row['type'];
                            $vehicleId = $row['vehicle_id'];
                        }
                    }
                ?>

                    <!-- <div class="container">

                        <h3 style="margin-top: 1.5em; margin-bottom: 1em; margin-left: 1.5em;">Current Booking Progress</h3>
                        <center>
                            <div class="progress-bar-div" style="width: 90%; height: 10em; border-radius: 20px;
    background: #FFF;
    box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.25);">
                        </center>
                    </div> -->

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-md-12 col-12 ">
                                <h3 style="margin-top: 1.5em; margin-bottom: 1em; margin-left: 1.5em;">Booking Details
                                </h3>
                                <!-- <center> -->
                                <div class="col-lg-12 col-md-12 col-12 d-flex justify-content-center">
                                    <div class="progress-bar-div detailed-booking " style="width: 80%; height: auto; border-radius: 20px;
            background: #FFF;
            box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.25);">
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><label for="">Booking Id</label></div>
                                            <div class="col-lg-6 col-6 text-end"><?php echo $bookingId ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><label for="">Travel</label></div>
                                            <div class="col-lg-6 col-6 text-end"><?php echo $pickUp . 'to' . $destination ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><label for="">Distance</label></div>
                                            <div class="col-lg-6 col-6 text-end"><?php echo $distance ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><label for="">Date & Time</label></div>
                                            <div class="col-lg-6 col-6 text-end"><?php echo $date . ' - ' . $time ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><label for="">Vehicle & Id</label></div>
                                            <div class="col-lg-6 col-6 text-end"> <?php echo $vehicle . ' & ' . $vehicleId ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><label for="">Driver & Id</label></div>
                                            <div class="col-lg-6 col-6 text-end"><?php echo $driver . ' & ' . $driverId ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><label for="">Total Amount</label></div>
                                            <div class="col-lg-6 col-6 text-end"><?php echo $amount ?></div>
                                        </div>

                                    </div>
                                </div>
                                <!-- </center> -->
                            </div>
                            <div class="col-lg-5 col-md-12 col-12">
                                <h3 style="margin-top: 1.5em; margin-bottom: 1em; margin-left: 1.5em;">Actions</h3>
                                <center>
                                    <div class="progress-bar-div" style="width: 80%; height: auto; padding-top: 1em;">
                                        <div class="col-12 mb-3">
                                            <button id="feedback-btn" style="background-color: #FFC300; color: #fff; width: 8em;height: 5em; border-radius: 10px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Add Feedback</button>
                                        </div>

                                        <div class="col-12">
                                            <form action="cancelBooking.php" method="post" id="cancelbookingForm">
                                                <input type="hidden" name="bookingId" value="<?php echo $bookingId ?>">
                                                <input type="hidden" name="date" id="date2">
                                                <input type="hidden" name="time" id="time2">
                                                <button id="cancelBtn" style="background-color: #EF6461; color: #fff; width: 8em;height: 5em; border-radius: 10px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Cancel Booking</button>
                                            </form>
                                        </div>


                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </section>

        </main>

    </div>

    <div class="newBooking">
        <div class="newBooking-conatiner">
            <!-- <h1 class="text-center mb-4" style="color: #fff; font-weight: bold; font-family: Roboto Serif;">Booking</h1> -->
            <form action="newBooking.php" method="post" id="new-booking-form">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Pick-up Point</label>
                        <input type="text" name="town_name" id="town_name" class="form-control form-new-booking mb-3">
                        <input type="hidden" class="form-control " name="distance1" id="distance" value="">
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Destination</label>
                        <input type="text" name="town_name2" id="town_name2" class="form-control form-new-booking mb-3">
                        <input type="hidden" class="form-control" name="distance2" id="distance2" value="">
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Vehicle type</label>

                        <?php

                        $sql = "SELECT * FROM vehicle WHERE availability = 'Available';";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {

                        ?>

                            <select name="cars" id="vehicleSelect" class="form-control form-new-booking mb-3" onchange="costCal()">
                                <option value="0">Select</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["cost_per_km"] . '" data-vehicle-id="' . $row["vehicle_id"] . '" data-driver-id="' . $row["driver_id"] . '" >' . $row["type"] . '</option>';
                                }
                                ?>
                            </select>
                        <?php
                        } else {
                            echo "0 Result";
                        }
                        ?>

                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Date</label>
                        <input type="date" name="date" id="dateinput" class="form-control form-new-booking mb-3">
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Time</label>
                        <input type="time" name="time" id="timeinput" class="form-control form-new-booking mb-3">
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Distance - </label>
                        <label for="" class="form-label" id="showDistance">0</label>
                        <label for="" class="form-label">km</label>
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Vehicle Cost - </label>
                        <label for="" class="form-label" id="showCost">0</label>
                        <label for="" class="form-label">Rs.</label>
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Total Amount - </label>
                        <label for="" class="form-label" id="showTot">0</label>
                        <label for="" class="form-label">Rs.</label>
                    </div>


                    <!-- input hiddens for complete the database table -->
                    <input type="hidden" name="totDistance" id="totDistance" class="form-new-booking">
                    <input type="hidden" name="amount" id="amount" class="form-new-booking">
                    <input type="hidden" name="customerId" id="customerId" value=<?php echo "'$customer_id'" ?> class="form-new-booking">
                    <input type="hidden" name="vehicleId" id="vehicleId" class="form-new-booking">
                    <input type="hidden" name="driverId" id="driverId" class="form-new-booking">

                    <center><button type="submit" class="btn btn-light mt-2" id="new-booking-btn">Done</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
    <h1 id="test"></h1>
    <!-- feedback -->
    <div class="feedback">
        <form action="feedbackInsert.php" id="new-feedback" method="post">
            <div class="conatiner">
                <h1 class="text-center mb-4" style="color: #fff; font-weight: bold; font-family: Roboto Serif;">Feed-Back</h1>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="titleinput" id="titleinput" class="form-control mb-3" required>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" placeholder="type here" name="news-description" id="floatingTextarea3" style="height: 100px; margin-bottom: 1em;" required></textarea>
                    </div>

                    <input type="hidden" name="date" id="date1">
                    <input type="hidden" name="time" id="time1">
                    <input type="hidden" name="bookingId" value="<?php echo $bookingId ?>">
                    <input type="hidden" name="customerId" value="<?php echo $customer_id ?>">


                    <center><button type="submit" class="btn btn-light mt-2" id="addfeedback">Add</button></center>
                </div>


            </div>
        </form>
    </div>

    <?php
    $sqlFindStatus = "SELECT * FROM booking_status where booking_booking_id = '$bookingId' order by date asc, time desc limit 1; ";
    $resultFindStatus = mysqli_query($conn, $sqlFindStatus);

    if (mysqli_num_rows($resultFindStatus) > 0) {
        while ($row = mysqli_fetch_assoc($resultFindStatus)) {
            $currentStatus = $row['status'];
        }
    }
    ?>
    <input type="hidden" name="" id="status" value="<?php echo $currentStatus ?>">


    <!-- payment window -->


    <div class="container-payment">

        <center>
            <h2>Express<span style="color: #fff;">Ride</span></h2>

            <h5 style="color: #FFF;">Current Payment - <?php echo $amount ?> </h5>
        </center>

        <center>
            <form action="paymentadd.php" method="post">
                <input type="text" class="mt-1 mb-3" name="paymentInput" style="width: 80%; border-color: transparent; border-radius: 5px;"><br>
                <button type="submit" class="btn btn-light pay-btn mb-3">Payment</button>
                <input type="hidden" id="date4" name="date4">
                <input type="hidden" id="time4" name="time4">
                <input type="hidden" id="BookingID-payment" name="BookingID-payment" value="<?php echo $bookingId ?>">
                <input type="hidden" id="customerID-payement" name="customerID-payement" value="<?php echo $customer_id ?>">
            </form>
        </center>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script>
    var status = document.getElementById('status').value;
    console.log(status);
    if (status == "reached") {
        $(".container-payment").css("visibility", "visible");
        $(".opa").css("visibility", "visible");

    }
</script>

<script>
    const menu_toggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");

    menu_toggle.addEventListener("click", () => {
        menu_toggle.classList.toggle("is-active");
        sidebar.classList.toggle("is-active");
    });

    // new booking & feedback container load
    $(document).ready(function() {
        $("#book-now").click(function() {
            $(".newBooking-conatiner").css("visibility", "visible");
            $(".opa").css("visibility", "visible");
        });

        $("#feedback-btn").click(function() {
            $(".feedback").css("visibility", "visible");
            $(".opa").css("visibility", "visible");
        });
    });
</script>

<script type="text/javascript">
    $(function() {

        // Single Select
        $("#town_name").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "search_data.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#town_name').val(ui.item.label); // display the selected text
                $('#distance').val(ui.item.value); // save selected id to input
                return false;
            },
            focus: function(event, ui) {
                $("#town_name").val(ui.item.label);
                $("#distance").val(ui.item.value);
                return false;
            },
        });

    });

    function split(val) {
        return val.split(/,\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }
</script>

<script type="text/javascript">
    $(function() {

        // Single Select town 2
        $("#town_name2").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "search_data.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#town_name2').val(ui.item.label); // display the selected text
                $('#distance2').val(ui.item.value); // save selected id to input
                return false;
            },
            focus: function(event, ui) {
                $("#town_name2").val(ui.item.label);
                $("#distance2").val(ui.item.value);
                return false;
            },
        });

    });

    function split(val) {
        return val.split(/,\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }
</script>

<script>
    //new booking
    // $("#new-booking-btn").click(function() {
    //     $.post($("#new-booking-form").attr("action"),
    //         $("#new-booking-form").serializeArray(),
    //         function(info) {
    //             $("#result").empty();
    //             $("#result").html(info);
    //         });

    //     $("#new-booking-form").submit(function() {
    //         return false;
    //     });
    // });

    // $(document).ready(function() {
    //     $("#new-booking-btn").click(function() {
    //         $(".newBooking-conatiner").css("visibility", "hidden");
    //         $(".opa").css("visibility", "hidden");
    //     });
    // });
</script>

<script>
    // add feedback
    // $("#addfeedback").click(function() {
    //     $.post($("#new-feedback").attr("action"),
    //         $("#new-feedback").serializeArray(),
    //         function(info) {
    //             $("#result").empty();
    //             $("#result").html(info);
    //         });
    //     window.setTimeout(function() {
    //         $("#result").alert('close');
    //     }, 2000);
    //     $("#new-feedback").submit(function() {
    //         return false;
    //     });
    // });

    // $(document).ready(function() {
    //     $("#addfeedback").click(function() {
    //         $(".feedback").css("visibility", "hidden");
    //         $(".opa").css("visibility", "hidden");
    //     });
    // });
</script>

<script>
    const date = new Date();

    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    let hour = date.getHours();
    let min = date.getMinutes();
    let sec = date.getSeconds();

    // This arrangement can be altered based on how we want the date's format to appear.
    let currentDate = `${year}-${month}-${day}`;
    let currenttime = `${hour}:${min}:${sec}`;

    document.getElementById('date1').value = currentDate;
    document.getElementById('time1').value = currenttime;

    document.getElementById('date2').value = currentDate;
    document.getElementById('time2').value = currenttime;

    document.getElementById('date4').value = currentDate;
    document.getElementById('time4').value = currenttime;
</script>



<script>
    let acceptation = document.getElementById('booking-acceptation').value;

    if ((acceptation != "not-accepted") && (acceptation != "canceled") && (acceptation != "empty") && (acceptation != "completed")) {
        $("#book-now").addClass("disabled");

    } else {
        $("#book-now").remove("disabled");

    }
</script>

<script>
    function costCal() {
        var distance1 = parseFloat(document.getElementById("distance").value);
        var distance2 = parseFloat(document.getElementById("distance2").value);
        var costPerKm = parseFloat(document.getElementById("vehicleSelect").value); //vehicle cost

        var distance = distance1 + distance2;
        var totalCost = distance * costPerKm;
        totalCost = totalCost.toFixed(2);


        document.getElementById("showDistance").innerHTML = distance;
        document.getElementById("showCost").innerHTML = costPerKm;
        document.getElementById("showTot").innerHTML = totalCost;

        document.getElementById("totDistance").value = distance;
        document.getElementById("amount").value = totalCost;

        var selectElement = document.getElementById("vehicleSelect");
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedText = selectedOption.innerText; //vehicle type
        var selectedVehicleId = selectedOption.getAttribute("data-vehicle-id"); //vehicle id
        var selectedDriverId = selectedOption.getAttribute("data-driver-id"); //driver id

        document.getElementById("vehicleId").value = selectedVehicleId; //set value to hidden inputs
        document.getElementById("driverId").value = selectedDriverId;
    }
</script>

</html>
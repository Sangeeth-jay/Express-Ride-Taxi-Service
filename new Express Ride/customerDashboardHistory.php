<?php
session_start();
include 'db/db_config.php';

$f_name = $_SESSION['f_name'];
$customer_id = $_SESSION['customer_id'];
$bookingIdTemp = '';
$bookingId;
$acceptation;

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
                <a href="customerDashboard.php" class="menu-item " id="tab1"> <img src="img/home.png" width="15%" alt="" style="margin-right: 1.5em;">Dashboard</a>
                <a href="customerDashboardHistory.php" class="menu-item is-active" id="tab2"> <img src="img/icons8-history-96.png" width="15%" alt="" style="margin-right: 1.5em;">History</a>
                <a href="customerDashboardFeedback.php" class="menu-item" id="tab3"> <img src="img/icons8-feedback-50.png" width="15%" alt="" style="margin-right: 1.5em;">Feedbacks</a>

            </nav>

        </aside>

        <main class="content">

            <section id="tab-history" class="tab-history">
                <h2 style="margin-left: 1em;margin-top: 1em; color: #2e3047;">History</h2>

                <center>

                    <table class="table" style="width:70vw;">
                        <thead class="table-bg-color-'#2e3047'">
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
                            // $bookingId = $_REQUEST['bookingId'];
                            $i = 0;

                            $sql = "SELECT b.*, v.type FROM booking b join vehicle v on b.vehicle_id = v.vehicle_id where customer_id = '$customer_id';";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $i++;

                                    $id = $row['booking_id'];
                                    $pickUp = $row['pickup_point'];
                                    $destination = $row['destination'];
                                    $vehicle = $row['type'];
                                    $amount = $row['amount'];
                                    $status = $row['acceptation'];

                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $id ?></th>
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
                </center>
            </section>
        </main>
    </div>
</body>

<script>
    const menu_toggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");

    menu_toggle.addEventListener("click", () => {
        menu_toggle.classList.toggle("is-active");
        sidebar.classList.toggle("is-active");
    });
</script>

<script>
    let acceptation = document.getElementById('booking-acceptation').value;

    if ((acceptation != "not-accepted") && (acceptation != "canceled") && (acceptation != "empty")) {
        $("#book-now").addClass("disabled");

    } else {
        $("#book-now").remove("disabled");

    }
</script>

</html>
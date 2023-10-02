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
    <link rel="stylesheet" href="css/customerDashboardFeedback.css">
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
                <a href="customerDashboardHistory.php" class="menu-item" id="tab2"> <img src="img/icons8-history-96.png" width="15%" alt="" style="margin-right: 1.5em;">History</a>
                <a href="customerDashboardFeedback.php" class="menu-item is-active" id="tab3"> <img src="img/icons8-feedback-50.png" width="15%" alt="" style="margin-right: 1.5em;">Feedbacks</a>

            </nav>

        </aside>

        <main class="content">

            <section id="tab-feedbacks" class="tab-feedbacks">

                <h2 style="margin-left: 1em;margin-top: 1em; color: #2e3047;">Feedbacks</h2>

                <div class="feedbacks-container">
                    <?php
                    $sqlfeedback = "SELECT * FROM feedback where customer_id = '$customer_id'; ";
                    $resultfeedback = mysqli_query($conn, $sqlfeedback);

                    if (mysqli_num_rows($resultfeedback) > 0) {
                        while ($row = mysqli_fetch_assoc($resultfeedback)) {
                            $feedId = $row['feedback_id'];
                            $bookingIdFeed = $row['booking_id'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $datefeed = $row['date'];
                            $timefeed = $row['time'];

                    ?><center>
                                <table style="margin-top: 2em;">

                                    <!-- <thead> -->
                                    <tr>
                                        <th scope="col" style="text-decoration: underline;">Booking ID</th>
                                        <th scope="col" style="text-decoration: underline;">Title</th>
                                        <th scope="col" style="text-decoration: underline;">Description</th>
                                        <th scope="col"><?php echo $datefeed ?></th>
                                        <th scope="col" rowspan="2">
                                            <form action="deleteFeedback.php" method="post">
                                                <input type="hidden" name="feedId" value="<?php echo $feedId ?>">
                                                <button style="border-radius: 5px; border: none;"><i class="bi bi-trash3"></i></button>
                                            </form>
                                        </th>


                                    </tr>
                                    <!-- </thead>
            <tbody> -->
                                    <tr>
                                        <td data-label="Booking ID"><?php echo $bookingIdFeed ?></td>
                                        <td data-label="Title"><?php echo $title ?></td>
                                        <td data-label="Description"><?php echo $description ?></td>
                                        <td data-label="<?php echo $datefeed ?>"><?php echo $timefeed ?></td>
                                        <!-- <button class="d-lg-none" style="border-radius: 5px; border: none;"><i class="bi bi-pencil-square"></i></button> -->
                                        <!-- <td> <button style="border-radius: 5px; border: none;"><i class="bi bi-trash3"></i></button>
                                        </td> -->
                                    </tr>
                                    <!-- </tbody> -->
                                </table>
                            </center>

                    <?php
                        }
                    }
                    ?>
                </div>
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
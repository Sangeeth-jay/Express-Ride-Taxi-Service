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
    <link rel="stylesheet" href="css/adminPannelVehicle.css">
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
                <a href="adminPannelStaff.php" class="menu-item " id="tab3"> <img src="img/icons8-users-64.png" width="15%" alt="" style="margin-right: 1.5em;">Add Staff</a>
                <a href="adminPannelVehicle.php" class="menu-item is-active" id="tab6"> <img src="img/icons8-bus-50.png" width="15%" alt="" style="margin-right: 1.5em;">Vehicle</a>
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
            <section id="tab-vehicle" class="tab-vehicle">
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

                <h1 style="margin-left: 1em;">Add New Vehicle</h1>
                <div class="container add-new">
                    <form action="addvehicle.php" method="post" id="add-vehicle">
                        <div class="row g-3 mb-3">
                            <div class="col-lg-6 col-md-12 col-12">
                                <label for="formGroupExampleInput" class="form-label">Vehicle Type</label>
                                <input type="text" class="form-control" name="vehicleType" id="formGroupExampleInput" placeholder="type here" required>
                            </div>
                            <?php
                            $sql = "SELECT * FROM user WHERE designation = '3' ;";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <div class="col-lg-6 col-md-12 col-12">
                                    <label for="inputState" class="form-label">Select Driver</label>
                                    <select id="inputState" class="form-control" name="driver" required>
                                        <?php while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row["user_id"] . '">' . $row["full_name"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-lg-6 col-md-12 col-12">
                                <label for="formGroupExampleInput" class="form-label">Cost per 1km</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" name="cost" placeholder="type here" required>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12">
                                <label for="inputState" class="form-label">Vehicle Status</label>
                                <select id="inputState" class="form-control" name="status" required>
                                    <option>Avilable</option>
                                    <option>Not-Avilable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-warning text-light" id="add_vehicle">Add Vehicle</button>
                            </div>
                        </div>
                    </form>
                <?php
                            } else {
                                echo "0 Result";
                            }
                ?>
                </div>

                <h1 style="margin-left: 1em;">Vehicle Details</h1>
                <div class="container vehicle-details">


                    <?php
                    $sqlVehicle = "SELECT v.*,v.driver_id, u.full_name FROM vehicle v join user u on v.driver_id = u.user_id;";
                    $resultVehicle = mysqli_query($conn, $sqlVehicle);

                    if (mysqli_num_rows($resultVehicle) > 0) {
                        while ($row = mysqli_fetch_assoc($resultVehicle)) {
                            $type = $row['type'];
                            $vehicleId = $row['vehicle_id'];
                            $driver = $row['full_name'];
                            $driverId = $row['driver_id'];
                            $cost = $row['cost_per_km'];
                            $status = $row['availability'];

                    ?>
                            <center>
                                <table style="margin-top: 2em;">
                                    <form action="updateVehicle.php" method="get">
                                        <!-- <thead> -->
                                        <tr>
                                            <th scope="col" style="text-decoration: underline;">Type</th>
                                            <th scope="col" style="text-decoration: underline;">ID</th>
                                            <th scope="col" style="text-decoration: underline;">Driver</th>
                                            <th scope="col" style="text-decoration: underline;">Cost</th>
                                            <th scope="col" style="text-decoration: underline;">Status</th>
                                            <th scope="col" rowspan="2">
                                                <button style="background-color: #FFC300; color: #fff; width: 6.5em;height: 5em; border-radius: 10px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Update</button>
                                            </th>

                                        </tr>
                                        <!-- </thead>
                            <tbody> -->
                                        <tr>
                                            <td data-label="Vehicle Type"><?php echo $type ?></td>
                                            <td data-label="Vehicle ID"><?php echo $vehicleId ?></td>
                                            <td data-label="Driver">

                                                <select id="inputState" class="form-select" name="driver">
                                                    <option value="<?php echo $driverId ?>"><?php echo $driver ?></option>
                                                    <?php

                                                    $sql = "SELECT * FROM user WHERE designation = '3' ;";
                                                    $result = mysqli_query($conn, $sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $row["user_id"] . '">' . $row["full_name"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>


                                            </td>
                                            <td data-label="Cost per 1km">

                                                <input type="text" class="form-control" id="formGroupExampleInput" name="costvalue" value="<?php echo $cost ?>">

                                            </td>
                                            <td data-label="Vehicle Status">

                                                <select id="inputState" class="form-select" name="status">
                                                    <option><?php echo $status ?></option>
                                                    <option>Avilable</option>
                                                    <option>Not-Avilable</option>
                                                </select>

                                            </td>
                                            <td style="text-align: center;" class="d-lg-none "><button style="background-color: #FFC300;color: #fff; width: 8em;height: 2em; border-radius: 10px; border: none; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">Update</button>
                                            </td>

                                        </tr>
                                        <!-- </tbody> -->
                                        <input type="hidden" name="vehicleId" id="" value="<?php echo $vehicleId ?>">
                                        <input type="hidden" name="cost" id="" value="<?php echo $cost ?>">

                                    </form>
                                </table>
                            </center>

                    <?php
                        }
                    }
                    ?>

                </div>

                <div class="text" id="details-text"> </div>
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

    // authentication

    let designation = document.getElementById('designation').value;

    if (designation == 2) {
        $("#tab3").addClass("disabled");
        $("#tab6").addClass("disabled");

    }
</script>

</html>
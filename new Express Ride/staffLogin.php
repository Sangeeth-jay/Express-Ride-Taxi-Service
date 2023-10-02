<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff-Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/staffLogin.css">
</head>

<body>

    <?php

    if (isset($_REQUEST['error'])) {
    ?>

        <center>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50vw;">
                <strong>Oops!</strong> <?php echo $_REQUEST['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </center>

    <?php
    }

    ?>

    <div class="main">
        <h1 class="text-center" style="color: rgb(0, 0, 0); font-weight: bold; font-family: Roboto Serif;">
            Express<span style="color: #FFC300; font-family: Roboto Serif; font-weight: bold;">Ride</span></h1>
        <div class="conatiner">
            <form action="staff_auth.php" method="post">
                <div class="row">
                    <div class="username col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">User Name</label>
                        <input type="text" name="userName" id="" placeholder="enter your username" class="form-control">
                    </div>
                    <div class="password col-lg-12 col-md-12 col-12">
                        <label for="" class="form-label">Password</label>
                        <input type="text" name="Password" id="" placeholder="enter your password" class="form-control">
                    </div>
                    <center><button type="submit" class="btn btn-light mt-4">Login</button></center>
                </div>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
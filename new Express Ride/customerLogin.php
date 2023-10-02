<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/customerLogin.css">
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


        <div class="conatiner">
            <h1 class="text-center" style="color: rgb(0, 0, 0); font-weight: bold; font-family: Roboto Serif;">
                Express<span style="color: #FFC300; font-family: Roboto Serif; font-weight: bold;">Ride</span></h1>

            <div class="login-form">

                <form action="customer_auth.php" method="get">
                    <div class="mb-3 mt-4">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" required name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" required name="password">
                    </div>
                    <center><button type="submit" class="btn btn-light">Login</button></center>
                    <center>
                        <div class="mb-3 form-check">
                            <label class="form-check-label mt-3 mb-4" for="exampleCheck1" style="margin-left: -10px;">Need to
                                create Account ? </label>
                            <a href="customerRegister.php" class="form-newAccount">Account</a>
                    </center>
            </div>
            </form>
        </div>

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
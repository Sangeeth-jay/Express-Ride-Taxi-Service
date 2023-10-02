<?php
include 'db/db_config.php';

$nic = $_REQUEST['nic'];
$id;
$designationValue;


$sql = 'SELECT * FROM user WHERE nic = "' . $nic . '" ';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['user_id'];
        $fullname = $row['full_name'];
        $username = $row['user_name'];
        $telephone = $row['telephone'];
        $designation = $row['designation'];
    }
    if($designation == 1){
        $designationValue = 'Admin';
    }elseif($designation == 2){
        $designationValue = 'Reservation Manager';
    }elseif($designation == 3){
        $designationValue = 'Driver';
    }
    
?>

    <form action="updatestaff.php" method="post" id="update_staff">
        <div class="row">
            <div class="fname col-lg-8 col-md-8 col-12">
                <label for="" class="form-label mt-3">Full Name</label>
                <input type="text" name="f_name" id="f_name" class="form-control" value="<?php echo $fullname ?>">
            </div>
            <div class="lname col-lg-4 col-md-4 col-12">
                <label for="" class="form-label mt-3">User Name</label>
                <input type="text" name="u_name" id="u_name" class="form-control" value="<?php echo $username ?>">
            </div>
            <div class="telephone col-lg-6 col-md-6 col-12">
                <label for="" class="form-label mt-3">Telephone</label>
                <input type="text" name="telephone" id="telephone" class="form-control" value="<?php echo $telephone ?>">
            </div>
            <div class="designation col-lg-6 col-md-6 col-12">
                <label for="" class="form-label mt-3">Designation</label> <label for="" class="form-label-desi mt-3" style="margin-left: 1em; font-size: 20px;" ><?php echo $designationValue ?></label>
                <select name="designation" id="designation" class="form-control">
                    <option value="0">Select</option>
                    <option value="1">Admin</option>
                    <option value="2">Reservation Manager</option>
                    <option value="3">Driver</option>
                </select>
            </div>


            <center>
                <div class="col-lg-6 col-md-12 col-12 "><button type="submit" class="btn btn-light yellow mt-4  " id="updatestaff" name="updatestaff">Update</button></div>
            </center>
    </form>
    <form action="deletestaffmember.php" id="delete-staff" method="post">
        <center>
            <div class="col-lg-6 col-md-12 col-12"><button type="submit" class="btn btn-light red mt-2" id="deletestaff">Delete</button></div>

        </center>
        <input type="hidden" name="user_id" id="setId" value="<?php echo $id ?>">

    </form>
    </div>



<?php


} else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-textt">
Invalid ID!           
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}


?>

<script>
    window.setTimeout(function() {
        $("#alert-textt").alert('close');
    }, 2000);
</script>
<script>
    $(document).ready(function() {


        $("#updatestaff").click(function() {
            $.post($("#update_staff").attr("action"),
                $("#update_staff :input").serializeArray(),
                function(info) {
                    $("#alert-text").empty();
                    $("#alert-text").html(info);
                });
            $('.form-control').val('');
            $("#update_staff").submit(function() {
                return false;
            });
            window.setTimeout(function() {
                $("#alert-text").alert('close');
            }, 2000);
        });
    });
</script>

<script>
    $(document).ready(function() {

        $("#deletestaff").click(function() {
            $.post($("#delete-staff").attr("action"),
                $("#delete-staff :input").serializeArray(),
                function(info) {
                    $("#alert-text").empty();
                    $("#alert-text").html(info);
                });
            $('.form-control').val('');
            $("#delete-staff").submit(function() {
                return false;
            });
            window.setTimeout(function() {
                $("#alert-text").alert('close');
            }, 2000);


        });
    });
</script>
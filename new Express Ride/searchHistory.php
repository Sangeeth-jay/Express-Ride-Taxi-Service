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
            $bookingId = $_REQUEST['bookingId'];
            $i = 0;

            $sql = "SELECT b.*, v.type FROM booking b join vehicle v on b.vehicle_id = v.vehicle_id where booking_id = '$bookingId';";
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
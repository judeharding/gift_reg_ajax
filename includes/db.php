<?php
    $mysqli = mysqli_connect('localhost', 'root', 'root', 'gift_registry');
    if ($mysqli) {
        // echo "CONNECTED" . "<br>";
    } else {
        die("Connection failed");
    }
?>
<?php
    $wait_time = "3";
?>

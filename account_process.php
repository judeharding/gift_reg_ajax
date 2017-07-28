<?php
    require("includes/db.php");
    require("includes/id_generator.php");
    $action = $_POST["action"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $account_id = id_generator();

    if ($action == "insert") {
        $sql = "INSERT INTO account SET account_id='$account_id', first_name='$first_name', last_name='$last_name', email='$email'";
        // $mysqli->query($sql);
        $result = mysqli_query($mysqli, $sql);
        if ($result == true) {
            $msg = "Record successfully inserted";
        } else {
            $msg = "Record NOT inserted";
        }
        echo $msg;
    }

?>

<?php
    require("includes/db.php");

    $action = $_POST["action"];


    if ($action == "insert") {
        require("includes/id_generator.php");
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $account_id = id_generator();

        $sql = "INSERT INTO account SET account_id='$account_id', first_name='$first_name', last_name='$last_name', email='$email'";
        // $mysqli->query($sql);
        $result = mysqli_query($mysqli, $sql);
    }

    if ($action == "delete") {
        $account_id = $_POST["account_id"];
        $sql = "DELETE FROM account WHERE account_id = '$account_id'";
        $result = mysqli_query($mysqli, $sql);
    }

?>

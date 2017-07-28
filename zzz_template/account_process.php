<?php
    require("includes/db.php");

    $action = $_POST["action"];
    $account_id = $_POST["account_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $submit = $_POST["submit"];
    // echo "$account_id | $first_name | $last_name | $email | $action | $submit";
    // echo "<br>";

    if ($action == "insert") {
        $sql = "INSERT INTO account SET account_id='$account_id', first_name='$first_name', last_name='$last_name', email='$email'";
        // $mysqli->query($sql);
        $result = mysqli_query($mysqli, $sql);
        if ($result == true) {
            $msg = "Record successfully inserted";
        } else {
            $msg = "Record NOT inserted";
        }
    }

    if ($action == "update") {
        $sql = "UPDATE account SET  first_name='$first_name', last_name='$last_name', email='$email' WHERE account_id='$account_id' ";
        $mysqli->query($sql);
        $msg = "Record successfully updated";
    }

    if ($action == "delete") {
        $sql = "DELETE FROM account WHERE account_id='$account_id'";
        $mysqli->query($sql);
        $msg = "Record successfully deleted";
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="<?php echo $wait_time; ?>; URL='account_list.php'" />
        <?php require ("header.php"); ?>
        <title></title>
    </head>
    <body>
        <?php require("includes/navbar.php"); ?>
        <?php
        echo $msg;
        ?>
    </body>
</html>

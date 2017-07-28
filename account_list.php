<?php
    require("includes/db.php");

    function getAccounts(){
        global $mysqli;
        $sql = "SELECT * FROM account";
        $result = mysqli_query($mysqli, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $account_id = $row["account_id"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
            // echo $first_name . "<br>";
            // echo $last_name . "<br>";
            // echo $email . "<br>";
            echo "<tr>";
                echo "<td><a href='account.php?action=view&account_id=$account_id'>$first_name</a></td>";
                echo "<td><a href='account.php?action=view&account_id=$account_id'>$last_name</a></td>";
                echo "<td><a href='account.php?action=view&account_id=$account_id'>$email</a></td>";
                echo "<td>
                            <a href='account.php?action=update&account_id=$account_id' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-pencil'></span> Edit</a>
                            <a href='account.php?action=delete&account_id=$account_id' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                      </td>";
            echo "</tr>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <?php
            require ("header.php");
        ?>
    </head>
    <body>
        <?php require("includes/navbar.php"); ?>

        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    <?php getAccounts(); ?>
                </table>
            </div>
        </div>
    </body>
</html>

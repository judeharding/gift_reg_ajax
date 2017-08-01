<?php
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
                            <a href='javascript:void(0);' class='btn btn-danger btn-sm' onclick='deleteAccount(\"$account_id\")'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                      </td>";
            echo "</tr>";
        }
    }
?>

<?php
    require("includes/db.php");

    // global $mysqli;
    $sql = "SELECT * FROM account ORDER BY last_name, first_name";
    $result = mysqli_query($mysqli, $sql);

    $account_list_data_table = "";
    $account_list_data_table = "
        <div class='table-responsive'>
            <table class='table'>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
    ";

                while ($row = mysqli_fetch_assoc($result)) {
                    $account_id = $row["account_id"];
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $email = $row["email"];
                    $account_list_data_table = $account_list_data_table . "
                        <tr>
                            <td><a href='account.php?action=view&account_id=$account_id'>$first_name</a></td>
                            <td><a href='account.php?action=view&account_id=$account_id'>$last_name</a></td>
                            <td><a href='account.php?action=view&account_id=$account_id'>$email</a></td>
                            <td>
                                <a href='javascript:void(0);' class='btn btn-info btn-sm' onclick='getAccount(\"$account_id\")'><span class='glyphicon glyphicon-pencil'></span> Edit</a>
                                <a href='javascript:void(0);' class='btn btn-danger btn-sm' onclick='deleteAccount(\"$account_id\")'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                            </td>
                        </tr>
                    ";
                }
    $account_list_data_table = $account_list_data_table .  "
            </table>
        </div>

    ";
    echo $account_list_data_table;
?>

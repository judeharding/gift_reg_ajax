<?php
    require("includes/db.php");

    // global $mysqli;
    $sql = "SELECT * FROM account";
    $result = mysqli_query($mysqli, $sql);

    $account_list_data_table = "";
    $account_list_data_table =
     "
        <div class='container-fluid' id='account_list_data'>
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
                        $account_list_data_table = $account_list_data_table .
                        "
                            <tr>
                                <td><a href='account.php?action=view&account_id=$account_id'>$first_name</a></td>
                                <td><a href='account.php?action=view&account_id=$account_id'>$last_name</a></td>
                                <td><a href='account.php?action=view&account_id=$account_id'>$last_name</a></td>
                                <td>
                                    <a href='account.php?action=update&account_id=$account_id' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-pencil'></span> Edit</a>
                                    <a href='account.php?action=delete&account_id=$account_id' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                                </td>
                            </tr>
                        ";
                    }
    $account_list_data_table = $account_list_data_table .  "
                </table>
            </div>
        </div>
    ";
    echo $account_list_data_table;
?>
<?php

include_once("../conndb.php");
include_once("../helpers/codehelpers.php");
$sql = "SELECT * FROM table_pegawai ORDER BY pgw_id ASC";
$result = $mysqli->query($sql);


?>

<html>

<head>
    <title>Homepage</title>
</head>

<body>
    <a href="add.php">Add New User</a><br /><br />

    <table width='80%' border=1>

        <tr>
            <th>NIK</th>
            <th>Name</th>
            <th>Agama</th>
            <th>Jabatan</th>
            <th>Tanggal Pegawai</th>
            <th>Action</th>
        </tr>
        <?php
        while ($user_data = $result->fetch_array(MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $user_data['pgw_nik'] . "</td>";
            echo "<td>" . $user_data['pgw_name'] . "</td>";
            echo "<td>" . agama_helper($user_data['pgw_agama']) . "</td>";
            echo "<td>" . jabatan_helper($user_data['pgw_jabatan']) . "</td>";
            echo "<td>" . date("d M Y", strtotime($user_data['pgw_register'])) . "</td>";
            echo "<td><a href='edit.php?idx=" . md5($user_data['pgw_id']) . "'>Edit</a> | <a href='delete.php?id=$user_data[pgw_id]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>
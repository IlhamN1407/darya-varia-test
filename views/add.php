<?php
include_once("../conndb.php");
$master_agama = $mysqli->query("SELECT * FROM master_agama order by agm_code ASC");
$master_jabatan = $mysqli->query("SELECT * FROM master_jabatan order by jbt_kode ASC");
?>


<html>

<head>
    <title>Add Users</title>
</head>

<body>
    <a href="index.php">Go to Home</a>
    <br /><br />

    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>NIK</td>
                <td><input type="text" name="nik"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td><label for="agama">Agama : </label></td>
                <td><select name="agama" id="agama" place>
                        <option value=""></option>
                        <?php while ($data_agama = mysqli_fetch_assoc($master_agama)) { ?>
                            <option value="<?= $data_agama['agm_code'] ?>"><?= $data_agama['agm_name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="jabatan">Jabatan : </label></td>
                <td><select name="jabatan" id="jabatan" place>
                        <option value=""></option>
                        <?php while ($data_jabatan = mysqli_fetch_assoc($master_jabatan)) { ?>
                            <option value="<?= $data_jabatan['jbt_kode'] ?>"><?= $data_jabatan['jbt_name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="tglpeg">Birthday (date and time):</label></td>
                <td><input type="datetime-local" id="tglpeg" name="tglpeg">
                </td>
            </tr>
            <tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $nik = $_POST['nik'];
        $name = $_POST['name'];
        $agama = $_POST['agama'];
        $jabatan = $_POST['jabatan'];
        $tglpeg = $_POST['tglpeg'];

        // Insert user data into table
        $sql = "INSERT INTO table_pegawai(pgw_nik,pgw_name,pgw_agama,pgw_jabatan,pgw_register) VALUES('$nik','$name',$agama,$jabatan, '$tglpeg')";
        if ($mysqli->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: index.php");
        } else {
            echo "Error adding record: " . $mysqli->error;
        }
    }
    ?>
</body>

</html>
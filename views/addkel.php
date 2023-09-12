<?php
include_once("../conndb.php");
$id = $_GET['idx'];
?>


<html>

<head>
    <title>Add Keluarga</title>
</head>

<body>
    <a href="edit.php">Go to back</a>
    <br /><br />

    <form action="addkel.php?idx=<?= $id ?>" method="post" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>Nama Keluarga</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td><label for="hub">Hubungan Keluarga : </label></td>
                <td><select name="hub" id="hub" place>
                        <option value=""></option>
                        <?php foreach (array("Ayah", "Ibu", "Adik", "Kakak") as $key) { ?>
                            <option value="<?= $key ?>"><?= $key ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="idx" value=<?php echo $_GET['idx']; ?>></td>
                <td><input type="submit" name="Submit" value="add"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $id = $_POST['idx'];
        $name = $_POST['name'];
        $hub = $_POST['hub'];
        $sql0 = $mysqli->query("SELECT * FROM table_pegawai where md5(pgw_id) = '$id'");
        while ($data_peg = mysqli_fetch_assoc($sql0)) {
            $idx = $data_peg['pgw_id'];
        }

        // Insert user data into table
        $sql = "INSERT INTO table_keluarga(pgw_id,kl_name,kl_hub) VALUES ($idx,'$name','$hub')";
        if ($mysqli->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: edit.php?idx=$id");
        } else {
            echo "Error adding record: " . $mysqli->error;
        }
    }
    ?>
</body>

</html>
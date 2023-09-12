<?php

include_once("../conndb.php");
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $name = $_POST['name'];
    $agama = $_POST['agama'];
    $jabatan = $_POST['jabatan'];
    $tglpeg = $_POST['tglpeg'];

    // update user data
    $sql = "UPDATE table_pegawai SET pgw_nik='$nik',pgw_name='$name',pgw_agama=$agama, pgw_jabatan=$jabatan, pgw_register='$tglpeg' WHERE md5(pgw_id) ='$id'";
    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    // Redirect to homepage to display updated user in list
    // header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['idx'];

// Fetech user data based on id
$sql = "SELECT * FROM table_pegawai WHERE md5(pgw_id) ='$id'";
$result = $mysqli->query($sql);
$master_agama = $mysqli->query("SELECT * FROM master_agama order by agm_code ASC");
$master_jabatan = $mysqli->query("SELECT * FROM master_jabatan order by jbt_kode ASC");
$keluarga = $mysqli->query("SELECT * FROM table_keluarga where md5(pgw_id) = '$id'");
while ($user_data = mysqli_fetch_assoc($result)) {
    $nik = $user_data['pgw_nik'];
    $name = $user_data['pgw_name'];
    $agama = $user_data['pgw_agama'];
    $jabatan = $user_data['pgw_jabatan'];
    $tgl = $user_data['pgw_register'];
}
?>
<html>

<head>
    <title>Edit User Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form name="update_user" method="post" action="edit.php?idx=<?= $_GET['idx'] ?>">
        <table border="0">
            <tr>
                <td>NIK</td>
                <td><input type="text" name="nik" value=<?php echo $nik; ?>></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
                <td><label for="agama">Agama : </label></td>
                <td><select name="agama" id="agama" place>
                        <option value=""></option>
                        <?php while ($data_agama = mysqli_fetch_assoc($master_agama)) { ?>
                            <option value="<?= $data_agama['agm_code'] ?>" <?= $data_agama['agm_code'] == $agama ? "selected" : "null" ?>><?= $data_agama['agm_name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="jabatan">Jabatan : </label></td>
                <td><select name="jabatan" id="jabatan" place>
                        <option value=""></option>
                        <?php while ($data_jabatan = mysqli_fetch_assoc($master_jabatan)) { ?>
                            <option value="<?= $data_jabatan['jbt_kode'] ?>" <?= $data_jabatan['jbt_kode'] == $jabatan ? "selected" : "null" ?>><?= $data_jabatan['jbt_name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="tglpeg">Birthday (date and time):</label></td>
                <td><input type="datetime-local" id="tglpeg" name="tglpeg" value="<?= $tgl ?>">
                </td>
            </tr>
            <tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['idx']; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
    <a href="addkel.php?idx=<?= $id ?>">Add New Keluarga</a><br /><br />
    <table width='80%' border=1>
        <tr>
            <th>Nama keluarga</th>
            <th>Hubungan</th>
            <th>Action</th>
        </tr>
        <?php
        while ($keluarga_data = mysqli_fetch_assoc($keluarga)) {
            echo "<tr>";
            echo "<td>" . $keluarga_data['kl_name'] . "</td>";
            echo "<td>" . $keluarga_data['kl_hub'] . "</td>";
            echo "<td><a href='editkel.php?idk=" . md5($keluarga_data['kl_id']) . "&idx=" . $_GET['idx'] . "'>Edit</a> | <a href='deletekel.php?id=$keluarga_data[kl_id]" . "&idx=" . $_GET['idx'] . " '>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>
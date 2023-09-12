<?php

include_once("../conndb.php");
if (isset($_POST['update'])) {
    $idpeg = $_POST['idpeg'];
    $id = $_POST['id'];
    $nik = $_POST['name'];
    $name = $_POST['hub'];
    // update user data
    $sql = "UPDATE table_keluarga SET kl_name='$nik',kl_hub='$name' WHERE md5(kl_id) ='$id'";
    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: edit.php?idx=$idpeg");
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
$idpeg = $_GET['idx'];
$idkel = $_GET['idk'];

// Fetech user data based on id
$sql = "SELECT * FROM table_keluarga WHERE md5(kl_id) ='$idkel'";
$result = $mysqli->query($sql);
while ($user_data = mysqli_fetch_assoc($result)) {
    $name = $user_data['kl_name'];
    $hub = $user_data['kl_hub'];
}
?>
<html>

<head>
    <title>Edit Keluarga Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form name="update_keluarga" method="post" action="editkel.php">
        <table border="0">
            <tr>
                <td>Nama keluarga</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
                <td><label for="hub">Hubungan Keluarga : </label></td>
                <td><select name="hub" id="hub" place>
                        <option value=""></option>
                        <?php foreach (array("Ayah", "Ibu", "Adik", "Kakak") as $key) { ?>
                            <option value="<?= $key ?>" <?= $key == $hub ? "selected" : null ?>><?= $key ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['idk']; ?>></td>
                <input type="hidden" name="idpeg" value=<?php echo $_GET['idx']; ?>>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>
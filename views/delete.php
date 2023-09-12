<?php

include_once("../conndb.php");


$id = $_GET['id'];


$sql = "DELETE FROM table_pegawai WHERE pgw_id=$id";
if ($mysqli->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: index.php");
} else {
    echo "Error deleting record: " . $mysqli->error;
}

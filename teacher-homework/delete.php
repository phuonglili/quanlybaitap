<?php

include('config/constants.php');
$sql = "delete from give_hw where id_hw = '$_GET[id_hw]'";
		mysqli_query($conn,$sql);
		header('location:exercise.php?id_hw=');
?>
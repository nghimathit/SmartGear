<?php
$id = (int)$_GET['id'];
$sql = "delete from `slider` where id = $id";
if(mysqli_query($conn, $sql)){
    redirect_to("?mod=slider&act=list_slider");
}
?>

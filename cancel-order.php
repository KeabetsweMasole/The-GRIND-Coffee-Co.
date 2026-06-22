<?php
session_start();
unset($_SESSION['active_order']);
header("Location: menu.php");
exit();
?>
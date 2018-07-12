<?php

session_start();
session_destroy();

unset ($_SESSION[`name`]);
unset ($_SESSION[`pname`]);

//echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
header('Location: ./index.php');

?>
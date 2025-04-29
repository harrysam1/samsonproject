<?php
session_start();
session_unset();
session_destroy();
setcookie("user_name", "", time() - 3600, "/"); // Optional cookie cleanup

header("Location: login.php");
exit();

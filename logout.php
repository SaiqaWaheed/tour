<?php
session_start();
session_unset(); // Session variables clear
session_destroy(); // Session destroy
header("Location: signin.html"); // Redirect to sign-in page
exit();
?>

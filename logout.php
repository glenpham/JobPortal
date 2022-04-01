<?php
session_start();
session_destroy();
// echo 'You have been logged out. <a href="/JobPortal">Go back to Home page</a>';
header("Location:/Jobportal");

?>
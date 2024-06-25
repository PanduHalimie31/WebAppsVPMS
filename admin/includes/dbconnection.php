<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con=mysqli_connect("localhost", "root", "", "vpmsdb");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}
?>
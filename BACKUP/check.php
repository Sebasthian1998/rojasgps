<?php
include('connection.php');
session_start();
$user_check=$_SESSION['username'];
$ses_sql = mysqli_query($db,"SELECT clicodcli FROM cliente WHERE clicodcli='$user_check' ");
$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$login_user=$row['clicodcli'];
if(!isset($user_check))
{
header("Location: index.php");
}
?>
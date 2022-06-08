<?php 

session_start();
// memulai session program logout
session_destroy();
//mengehentikan session yang diawali oleh users untuk redirect ke form login di index.php
header("Location: index.php");

?>
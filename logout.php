<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["pass"]);
header("location:index.php");
<?php
session_start();
print_r( json_decode($_SESSION['timetable'],true));
?>
<?php
session_start();
echo json_decode($_SESSION['timetable'],true);
?>
<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'fish_inventory') or die('Connection: ' . mysqli_connect_error());
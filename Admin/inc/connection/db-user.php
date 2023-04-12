<?php

session_start();

$conn = mysqli_connect('localhost', 'root', 'my_password', 'fish_inventory') or die('Connection: ' . mysqli_connect_error());
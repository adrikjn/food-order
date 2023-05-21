<?php

// Include constants.php for SITEURL
include('../config/constants.php');

// 1. Destroy the Session
session_destroy(); //Unset $_SESSION['user']

// 2. Redirect to Login Page
header('Location:' . SITEURL . 'admin/login.php');

<?php

/**
 * This file contains the function logIn()
 *
 * @author Adithya P N<adithya.pn@codilar.com>
 * @return void
 */

session_start();
session_destroy();
header("Location:login.php");

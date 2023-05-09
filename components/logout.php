<?php
session_start();
include("db/db_connection.php");
session_destroy();
header("Location: ../login.php");

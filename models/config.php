<?php

// Base de données
define('HOST', 'localhost');
define('DBNAME', 'cinerama');
define('LOGIN', 'root');
define('PASSWORD', 'root');


include 'database.php';
include 'comments.php';
include 'medias.php';
include 'posts.php';
include 'users.php';
session_start();
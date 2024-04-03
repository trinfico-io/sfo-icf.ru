<?php
// efc657cc-c12f-4ce3-98fc-57899177bb18.php
// в качестве замены загрузки файла на FTP
if (!isset($_GET['access']) || ($_GET['access'] != 'alefsupport')) die('access deny!');

$incoming = "../docs/";

if (!isset($_POST))
    die("Error request!");

if (!isset($_POST['public_file_name']))
    die("Error file name or file too large!");

if (!isset($_FILES) || $_FILES['public_file']['error'] != 0)
    die("Error file upload!");

if (!move_uploaded_file($_FILES['public_file']['tmp_name'], $incoming . $_POST['public_file_name']))
    die("Error uploaded file move!");

echo "ok";
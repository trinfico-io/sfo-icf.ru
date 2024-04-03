<?php
// 69f522e6-9c8c-409b-a41e-f4c6e323d4de.php
// в качестве замены удаления файла на FTP
if (!isset($_GET['access']) || ($_GET['access'] != 'alefsupport')) die('access deny!');

$incoming = "../docs/";

if (!isset($_POST))
    die("Error request!");

if (!isset($_POST['public_file_name']))
    die("Error file name!");

if (!unlink($incoming . $_POST['public_file_name']))
    die("Delete file problem!");

echo "ok";
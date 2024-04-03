#!/usr/bin/php
<?
# скрипт отрабатывает по cron раз в день перед бекапом, тупо апдейтит единственную запись в табличке текущей датой
$con1 = mysql_connect("localhost", "icf-sfo", "O7q9U8w4") or error_log("Autoset MySQL-backup date error[1] on SFO ICF! ".mysql_error(), 1, "sqlalert@trinfico.ru");
mysql_select_db("icf-sfo", $con1) or error_log("Autoset MySQL-backup date error[2] on SFO ICF! ".mysql_error(), 1, "sqlalert@trinfico.ru");
mysql_query("set CHARACTER SET utf8") or error_log("Autoset MySQL-backup date error[3] on SFO ICF! ".mysql_error(), 1, "sqlalert@trinfico.ru");

$result = mysql_query("select * from backup") or error_log("Autoset MySQL-backup date error[4] on SFO ICF! ".mysql_error(), 1, "sqlalert@trinfico.ru");
$result = mysql_fetch_array($result) or error_log("Autoset MySQL-backup date error[5] on SFO ICF! ".mysql_error(), 1, "sqlalert@trinfico.ru");
$msg = "Old value -> ".$result[0];
mysql_query("UPDATE backup SET backup_date = '".date('d.m.Y')."'") or error_log("Autoset MySQL-backup date error[6] on SFO ICF! ".mysql_error(), 1, "sqlalert@trinfico.ru");
$result = mysql_query("select * from backup") or error_log("Autoset MySQL-backup date error[7] on SFO ICF! ".mysql_error(), 1, "sqlalert@trinfico.ru");
$result = mysql_fetch_array($result) or error_log("Autoset MySQL-backup date error[8] on SFO ICF! ".mysql_error(), 1, "sqlalert@trinfico.ru");
$msg .= "; New value -> ".$result[0];

echo "End of autoset MySQL-backup date on new server SFO ICF. ".$msg."; Now -> ".date('d.m.Y H:i:s');
?>
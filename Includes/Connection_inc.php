<?php
// In this page, we open the connection to the Database
// Our MySQL database (blueprintdb) for the Blueprint Application
// Function to connect to the DB
function connectToDB() {
    // These four parameters must be changed dependent on your MySQL settings
    $hostdb = 'mv2-enquetes.com';   // MySQl host
    $userdb = 'mv2ly';    // MySQL username
    $passdb = 'mv2ly2vm';    // MySQL password
    $namedb = 'stif';   // MySQL database name

    $link = mysql_connect ($hostdb, $userdb, $passdb);
	mysql_set_charset("utf8");

    if (!$link) {
        // we should have connected, but if any of the above parameters
        // are incorrect or we can't access the DB for some reason,
        // then we will stop execution here
        die('Could not connect: ' . mysql_error());
    }

    $db_selected = mysql_select_db($namedb);
    if (!$db_selected) {
        die ('Can\'t use database : ' . mysql_error());
    }
    return $link;
}
?>
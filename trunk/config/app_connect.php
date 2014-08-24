<?php
define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "db_borrow");

$conn = mysql_connect(HOST, USERNAME, PASSWORD);
if ($conn) {
    mysql_select_db(DATABASE);
    mysql_query("SET NAMES UTF8");
} else {
    mysql_error();
}
?>

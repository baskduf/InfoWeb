<?php
function db_init($host, $duser, $dpw, $dbname)
{
    $conn =mysqli_connect($host,$duser,$dpw);

    mysqli_select_db($conn, $dbname);
    return $conn;
}

?>
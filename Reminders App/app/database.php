<?php

/* database connection stuff here
 * 
 */

function db_connect() {
    try { 
        $dbh = new PDO('mysql:host=' . DB_HOST . ';port='. DB_PORT . ';dbname=' . DB_DATABASE, DB_USER, DB_PASS);
        return $dbh;
    } catch (PDOException $e) {
        echo "Database is down. Error: " . $e->getMessage();
        // We should set a global variable here so we know the DB is down.
        $_SESSION['DB_DOWN'] = true;
        exit;
    }
}
?>
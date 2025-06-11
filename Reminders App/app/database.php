<?php

/* database connection stuff here
 * 
 */

function db_connect() {
    try { 
        $dsn = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s',
            DB_HOST,
            DB_PORT,
            DB_DATABASE
        );
        $dbh = new PDO($dsn, DB_USER, DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    } catch (PDOException $e) {
        echo "Database connection failed. Error: " . $e->getMessage();
        // We should set a global variable here so we know the DB is down.
        $_SESSION['DB_DOWN'] = true;
        exit;
    }
}
?>
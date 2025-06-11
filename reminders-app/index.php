<?php 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'app/init.php';

try {
    $app = new App;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    if (isset($app) && $app->db) {
        echo '<br>DB Connection: Active';
    } else {
        echo '<br>DB Connection: Failed';
    }
}
?>
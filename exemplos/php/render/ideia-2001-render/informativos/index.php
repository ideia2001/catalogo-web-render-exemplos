<?php
echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<?php
require '../../requestAPI.php';
include '../../shared.php';
?>

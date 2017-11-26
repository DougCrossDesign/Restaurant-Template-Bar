<?php
try {
    require("includes.php");
    $controller = new AdminController\Dashboard();
    $controller->index();
} catch (Exception $e) {
    Error::exception($e);
}
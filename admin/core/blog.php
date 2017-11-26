<?php
try {
    require("includes.php");

    $controller = new Controller\Dashboard();

    $action = Input::get('action');

    $response = $controller->run($action);

    $response->render();

} catch (Exception $e) {
    Error::exception($e);
}
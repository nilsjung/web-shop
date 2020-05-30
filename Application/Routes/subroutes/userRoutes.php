<?php

use Controller\UserController;

/**
 * Get current session user information
 *
 * Route User `/user`
 * Method GET
 *
 */
$router->get('/user', function (\Router\Request $request) {
    $controller = new UserController(new Model\User());

    $id = \Controller\SessionController::getAuthenticatedUserId();

    if ($id === null) {
        return "";
    }

    $user = $controller->getUserById($id);

    $view = new View\UserView($user);

    return $view->render();
});

/**
 * update user information
 *
 * Route `/user
 * Method POST
 *
 */
$router->post('/user', function (\Router\Request $request): string {
    $controller = new UserController(new \Model\User());
    $id = \Controller\SessionController::getAuthenticatedUserId();

    if ($id === null) {
        return "";
    }

    $firstName = $request->getParam("first_name");
    $lastName = $request->getParam("last_name");
    $emailAddress = $request->getParam("email_address");
    $password = $request->getParam("password");

    if (!($firstName || $lastName || $emailAddress || $password)) {
        return "";
    }

    $request->checkToken();

    $user = $controller->updateUserById(
        $id,
        $firstName,
        $lastName,
        $emailAddress,
        $password
    );

    $view = new View\UserView($user);

    return $view->render();
});

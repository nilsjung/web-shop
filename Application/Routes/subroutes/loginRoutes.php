<?php

use Controller\UserController;

/**
 * Render the login formula
 *
 * Route Login `/login`
 * Method GET
 */
$router->get('/login', function () {
    $view = new View\LoginView(new \Model\QueryResult(null, null));
    return $view->render();
});

/**
 *
 * User login
 *
 * Route `/login`
 * Method POST
 *
 * Body email-address=<email@adress>&password=<password>
 */
$router->post('/login', function (\Router\Request $request) {
    $emailAddress = $request->getParam("email_address");
    $password = $request->getParam("password");

    if (!($emailAddress && $password)) {
        return "missing parameter";
    }

    \Controller\SessionController::resetSessionToken();

    $controller = new UserController(new \Model\User());
    $queryResult = $controller->getUserByEmail($emailAddress);

    $loginView = new \View\LoginView($queryResult);

    if ($queryResult->hasError()) {
        return $loginView->render();
    }

    if (
        $controller->validatePassword($password, $queryResult->getResult()) ===
        false
    ) {
        $loginView->validationError();

        return $loginView->render();
    }

    \Controller\SessionController::setAuthenticatedState(true);
    \Controller\SessionController::setAuthenticatedUserId(
        $queryResult->getResult()->getId()
    );

    header("Location: /user");
});

/**
 * User logout
 *
 * Route Logout
 * Method Post
 */
$router->get('/logout', function () {
    \Controller\SessionController::destroySession();

    header("Refresh:0; url=/login");
});

<?php

namespace Controller;

use Model\User;

class UserController extends Controller {

    /**
     * UserController constructor.
     *
     * @param User $model
     */
    public function __construct( User $model ) {
        parent::__constructor($model);
    }

    /**
     * @param String $id
     * @return User|null
     */
    public function getUserById( String $id ): ?User {
        $this->model = $this->model->findById($id);
        return $this->model;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail( string $email ): ?User {
        $this->model = $this->model->findByEmailAddress($email);
        return $this->model;
    }

    /**
     * @param string $enteredPassword
     * @return bool
     */
    public function validatePassword( string $enteredPassword ): bool {
        if ( strcmp($this->model->getPassword(), $enteredPassword) === 0 ) {
            return true;
        }

        return false;
    }
}
<?php

namespace Src\Validations\Client;

class UserValidate {
    protected $errors = [];

    public function validate(array $data) {
        if (empty($data['name'])) {
            $this->addErrors('name', 'Name is required.');
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->addErrors('email', 'Invalid email format.');
        }

        if (empty($data['phone']) || !preg_match('/^\d{9,15}$/', $data['phone'])) {
            $this->addErrors('phone', 'Invalid phone number.');
        }

        if (empty($data['password']) || strlen($data['password']) < 6) {
            $this->addErrors('password', 'Password must be at least 6 characters long.');
        }

        return empty($this->errors);
    }

    protected function addErrors($field, $message) {
        $this->errors[$field][] = $message;
    }

    public function getErrors() {
        return $this->errors;
    }
}

<?php

namespace App\Traits;

use App\Helper;

trait ValidatorTrait
{
    private function validateId($id)
    {
        $id = (int)$id;
        if ($id < 1) {
            return false;
        }

        return $id;
    }

    private function validateEmail($email)
    {
        $email = (string)$email;

        if (strlen($email) < 7 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return $email;
    }

    private function validatePhone($phone)
    {
        $phoneDigitsLength = 11;

        $p = Helper::onlyDigits(Helper::formatPhoneNumber($phone));

        if (strlen($p) !== $phoneDigitsLength || Helper::formatPhoneNumber($phone) !== $phone) {
            return false;
        }

        return $phone;
    }

    private function validatePassword($password)
    {
        $password = (string)$password;
        $errors = [];

        $minLength = 6;
        $maxLength = 30;

        // Минимальная длина
        if (strlen($password) < $minLength) {
            $errors[] = "Пароль должен быть не менее 6 символов.";
        }

        // Максимальная длина
        if (strlen($password) > $maxLength) {
            $errors[] = "Пароль должен быть не более 30 символов.";
        }

        // Проверка наличия хотя бы одного большого символа
        if (!preg_match('/[A-ZА-Я]/u', $password)) {
            $errors[] = "Пароль должен содержать хотя бы одну заглавную букву.";
        }

        // Проверка наличия хотя бы одной цифры
        if (!preg_match('/\d/', $password)) {
            $errors[] = "Пароль должен содержать хотя бы одну цифру.";
        }

        // Возврат ошибки, если есть ошибки
        return count($errors) ? $errors : true;
    }
}

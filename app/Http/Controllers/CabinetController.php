<?php

namespace App\Http\Controllers;

use App\Traits\ValidatorTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class CabinetController extends Controller
{
    use ValidatorTrait;

    /**
     * Список параметров, которые будут переданы в шаблон
     *
     * @var array
     */
    private $params = [];
    /**
     * Массив хлебных крошек
     *
     * @var array
     */
    private $breadCrumbs = [];

    /**
     * Активный пользователь системы
     *
     * @var User
     */
    private $user;

    /*************************************************** ПУБЛИЧНЫЕ МЕТОДЫ ***************************************************/

    /**
     * Обработка главной страницы кабинета аутентифицированного пользователя
     *
     * @return \Closure|\Illuminate\Container\Container|mixed|object|null
     */
    public function getIndexPage()
    {
        if (!$this->checkUser()) {
            return redirect(route('site.index')); // TODO: переделать на страницу логина
        }

        $this->addParam('pageTitle', 'Главная');

        return $this->render('cabinet.index');
    }

    public function getRegisterPage()
    {
        if ($this->checkUser()) {
            return redirect(route('cabinet.getIndexPage'));
        }

        $this->addParam('pageTitle', 'Регистрация');

        return $this->render('auth.register');
    }

    public function postRegisterPage(Request $request)
    {
        $errors = [];
        $oldValues = [];

        // Проверка email
        $email = $request->post('email');
        $oldValues['email'] = $email;
        if (!$this->validateEmail($email)) {
            $errors['email'] = 'Введите корректный Email';
        }

        // проверка номера телефона
        $phone = $request->post('phone');
        $oldValues['phone'] = $phone;
        if (!$this->validatePhone($phone)) {
            dd("Номер не валидный");
            $errors['phone'] = 'Введите корректный номер телефона';
        }

        // Проверка пароля:
        $password = $request->post('password');
        $passwordErrors = $this->validatePassword($password);
        if ($passwordErrors !== true) {
            $errors['password'] = implode('<br>', $passwordErrors);
        }

        $passwordConfirm = $request->post('password_confirm');
        if ($password !== $passwordConfirm) {
            $passwordConfirmErrorText = 'Введенные пароли не совпадают';
            if (isset($errors['password'])) {
                $errors['password'] .= '<br>' . $passwordConfirmErrorText;
            } else {
                $errors['password'] = $passwordConfirmErrorText;
            }
        }

        // Проверка принятия условий:
        $terms = $request->post('terms');
        if (!$terms || $terms !== 'on') {
            $errors['terms'] = 'Вы должны согласиться с условиями обработки персональных данных';
        }

        if (count($errors)) {
            $this->addParam('templateErrors', $errors);
            $this->addParam('oldValues', $oldValues);
            return $this->render('auth.register');
        }

        // проверим, был ли уже такой email зарегистрирован:
        if (User::getByEmail($email)) {
            $errors['email'] = 'Пользователь с таким Email уже зарегистрирован.<br><a href="' . route('cabinet.getLoginPage') . '"> Авторизуйтесь </a> или введите другой email';

            $this->addParam('templateErrors', $errors);
            $this->addParam('oldValues', $oldValues);
            return $this->render('auth.register');
        }

        // Проверим, был ли зарегистрирован такой номер телефона:
        if (User::getByPhone($phone)) {
            $errors['phone'] = 'Пользователь с таким номером телефона уже зарегистрирован.<br><a href="' . route('cabinet.getLoginPage') . '"> Авторизуйтесь </a> или введите другой номер телефона';

            $this->addParam('templateErrors', $errors);
            $this->addParam('oldValues', $oldValues);
            return $this->render('auth.register');
        }

        dd("Регистрация POST все хорошо");
    }


    public function getLoginPage()
    {
        dd('Страница авторизации');
    }


    /*************************************************** ПРИВАТНЫЕ МЕТОДЫ ***************************************************/

    /**
     * Проверяет наличие аутентифицированного пользователя в системе
     *
     * @return bool
     */
    private function checkUser()
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        $this->user = $user;

        return true;
    }

    /**
     * Добавляет/заменяет значение параметра $key в массиве переменных шаблона
     *
     * @param string $key
     * @param $value
     * @return void
     */
    private function addParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * Возвращает список параметров (переменных) для рендера шаблона
     *
     * @return array
     */
    private function getParams()
    {
        // Добавим текущую страницу в хлебные крошки
        if (isset($this->params['pageTitle'])) {
            $this->addBreadCrumb($this->params['pageTitle'], route(Route::current()->getName()));
        }

        $this->addParam('user', $this->user);
        $this->addParam('breadCrumbs', $this->breadCrumbs);

        return $this->params;
    }

    /**
     * Добавляем запись в хлебные крошки
     *
     * @param $title
     * @param $href
     * @return void
     */
    private function addBreadCrumb($title, $url)
    {
        $this->breadCrumbs[] = [
            'title' => $title,
            'url' => $url
        ];
    }

    /**
     * Отправляет шаблон в буфер вывода
     *
     * @param $view
     * @return \Closure|\Illuminate\Container\Container|mixed|object|null
     */
    private function render($view = '')
    {
        $params = $this->getParams();
        if (isset($params['pageTitle'])) {
            $params['pageTitle'] = $params['pageTitle'] . ' | ' . env('APP_NAME');
        } else {
            $params['pageTitle'] = env('APP_NAME');
        }

        return view($view, $params);
    }
}

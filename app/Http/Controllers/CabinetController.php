<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CabinetController extends Controller
{
    /**
     * Список параметров, которые будут переданы в шаблон
     *
     * @var array
     */
    private $params = [];

    /**
     * Активный пользователь системы
     *
     * @var User
     */
    private $user;

    /**
     * Обработка главной страницы кабинета аутентифицированного пользователя
     *
     * @return \Closure|\Illuminate\Container\Container|mixed|object|null
     */
    public function getIndexPage()
    {
        if (!$this->checkUser()) {
            return redirect(route('site.index'));
        }

        return $this->render('cabinet.index');
    }

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
        $this->addParam('user', $this->user);

        return $this->params;
    }

    /**
     * Отправляет шаблон в буфер вывода
     *
     * @param $view
     * @return \Closure|\Illuminate\Container\Container|mixed|object|null
     */
    private function render($view = '')
    {
        return view($view, $this->getParams());
    }
}

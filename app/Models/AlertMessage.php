<?php

namespace App\Models;

use App\Traits\ValidatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AlertMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'text',
    ];

    const TYPE_SUCCESS = 'success';
    const TYPE_ERROR = 'error';
    const TYPE_INFO = 'info';

    const TYPES = [
        self::TYPE_SUCCESS,
        self::TYPE_ERROR,
        self::TYPE_INFO,
    ];

    const MIN_TEXT_LEN = 5;

    /**
     * Добавляем сообщение для пользователя
     *
     * @param $userId
     * @param $type
     * @param $text
     * @return void
     */
    public static function addMessage($userId, $type, $text)
    {
        $userId = self::validateUserId($userId);
        $type = self::validateType($type);
        $text = self::validateText($text);

        $message = new self([
            'user_id' => $userId,
            'type' => $type,
            'text' => $text,
        ]);

        $message->save();
    }

    /**
     * Возвращает сообщения для пользователя по userId
     *
     * @param $userId
     * @return mixed
     */
    public static function getUserMessages($userId)
    {
        $userId = self::validateUserId($userId);

        return self::where('user_id', $userId)->orderBy('created_at')->get();
    }

    /**
     * Добавляем сообщение текущему пользователю
     *
     * @param $type
     * @param $text
     * @return void|null
     */
    public static function addMessageForCurrentUser($type, $text) {
        $authUser = Auth::user();
        if ($authUser && $userId = self::validateUserId($authUser->id)) {
            return self::addMessage($authUser->id, $type, $text);
        }

        // Пользователь не авторизован. Будем писать в сессию
        if (session()->has('alertMessages')) {
            // Запись о сообщениях уже была
            $messages = session('alertMessages');
            $messages[] = $text;
        } else {
            // ключа alertMessages в сессии еще не было, создадим
            $messages = [$text];
        }

        session(['alertMessages' => $messages]);
    }

    /******************************************************* ВАЛИДАТОРЫ ***********************************************/
    private static function validateUserId($userId)
    {
        $userId = (int)$userId;

        if ($userId < 1) {
            throw new \DomainException('User_id "' . $userId . '" is not available. ');
        }

        return $userId;
    }

    private static function validateType($type)
    {
        $type = (string)$type;

        if (!in_array($type, self::TYPES)) {
            throw new \DomainException('Message type "' . $type . '" is not available.');
        }

        return $type;
    }

    private static function validateText($text)
    {
        $text = (string)$text;

        if (strlen($text) < self::MIN_TEXT_LEN) {
            throw new \DomainException('Text len(' . strlen($text) . ' symbols) is very small.');
        }

        return $text;
    }
}

<?php

namespace App\Models;

use App\Traits\ValidatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function addMessage($userId, $type, $text)
    {
        $userId = (int)$userId;
        $type = (string)$type;
        $text = (string)$text;

        if ($userId < 1) {
            throw new \DomainException('User_id "' . $userId . '" is not available. ');
        }

        if (!in_array($type, self::TYPES)) {
            throw new \DomainException('Message type "' . $type . '" is not available.');
        }

        if (strlen($text) < self::MIN_TEXT_LEN) {
            throw new \DomainException('Text len(' . strlen($text) . ' symbols) is very small.');
        }

        $message = new self([
            'user_id' => $userId,
            'type' => $type,
            'text' => $text,
        ]);

        $message->save();
    }

    public static function getUserMessages($userId)
    {
        $userId = (int)$userId;

        if ($userId < 1) {
            throw new \DomainException('User_id "' . $userId . '" is not available. ');
        }

        return self::where('user_id', $userId)->orderBy('created_at')->get();
    }
}

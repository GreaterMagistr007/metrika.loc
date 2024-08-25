<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    use HasFactory;


    /**
     * Возвращает сущность по её id
     *
     * @param $id
     * @return self|null
     */
    public static function getById($id)
    {
        $id = (int)$id;
        if ($id < 1) {
            return null;
        }

        return self::where('id', $id)->first();
    }
}

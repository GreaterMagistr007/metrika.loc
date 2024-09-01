<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Возвращает список кабинетов, к которым пользователь имеет отношение
     * @return BelongsToMany
     */
    public function cabinets()
    {
        return $this->belongsToMany(Cabinet::class, 'user_cabinets', 'user_id', 'cabinet_id');
    }

    /**
     * Возвращает сущность активного кабинета для пользователя
     * @return Cabinet|null
     */
    public function getActiveCabinet()
    {
        $userId = $this->id;
        $query = "
            SELECT
                cabinet_id
            FROM
                user_cabinets
            WHERE
                user_id = $userId
                AND is_active = 1
            LIMIT 1
        ";

        $result = DB::select($query);

        return isset($result[0]->cabinet_id) ? Cabinet::getById($result[0]->cabinet_id) : null;
    }


    /**
     * Находит пользователя по его id
     *
     * @param $id
     * @return self|null
     */
    public static function getById($id)
    {
        return self::where('id', $id)->first();
    }

    /**
     * Находит пользователя по его email
     *
     * @param $id
     * @return self|null
     */
    public static function getByEmail($email)
    {
        return self::where('email', $email)->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public static function authenticate(string $email, string $password): ?self
    {
        $user = self::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return null;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
    }
}

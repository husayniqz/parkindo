<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    
    protected $fillable = [
        'nama_user', 'username', 'password', 'role', 'status_aktif'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Helper untuk cek role di view/middleware
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}
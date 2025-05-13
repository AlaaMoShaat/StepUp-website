<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasTranslations;

    public $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getStatusTranslatable()
    {
        if( app()->getLocale() == 'ar') {
            return $this->status == 1? 'مفعل' : 'غير مفعل';
        }else {
            return $this->status == 1? 'Active' : 'Inactive';
        }
    }

    public function hasAccess($permession_to_check)  // products , users , admins
    {
        $role = $this->role;

        if (!$role) {
            return false;
        }

        foreach ($role->permession as $permession) {
            if ($permession_to_check == $permession ?? false) {
                return true;
            }
        }
    }
}

<?php

namespace App\Models\Users;

use App\Enums\Departments\UsersAdminDepartmentStatusType;
use App\Models\Departments\Department;
use App\Models\Images\Image;
use App\Models\Products\ProductsFavourite;
use App\Models\Quiz\Test;
use App\Models\Quiz\TestUsersTests;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    const TABLE = 'users';
    protected $table = self::TABLE;
    protected $guarded = 'web';
    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'phone',
        'username',
        'parent_id',
        'region_id',
        'code',
        'department_id',
        'facebook_token',
        'facebook_refresh_token',
        'facebook_id',
        'google_id',
        'google_token',
        'google_refresh_token',
        'address',
        'is_change_password',
        'reset_password',
        'expiry_date',
        'vip',
        'description',
        'permission_category',
        'is_force_login',
        'locked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function default()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_default', 1)->first();
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
        //return $this->belongsToMany(Role::class, 'role_user', 'role_id', 'user_id');
    }

    public function manager()
    {
        return $this->hasMany(UserAdminDepartment::class, 'user_id', 'id')
            ->where('type', UsersAdminDepartmentStatusType::Manager)
            ->get();
    }

    public function main()
    {
        return $this->hasMany(UserAdminDepartment::class, 'user_id', 'id')
            ->where('type', UsersAdminDepartmentStatusType::Main)
            ->get();
    }

    public function sub()
    {
        return $this->hasMany(UserAdminDepartment::class, 'user_id', 'id')
            ->where('type', UsersAdminDepartmentStatusType::Sub)
            ->get();
    }

    public function expert()
    {
        return $this->hasOne(UserAdminDepartment::class, 'user_id', 'id')
            ->where('type', UsersAdminDepartmentStatusType::Expert)
            ->get();
    }

    public function productsFavourite()
    {
        return $this->hasMany(ProductsFavourite::class, 'user_id', 'id');
    }

    public function tests()
    {
        return $this->hasMany(TestUsersTests::class, 'user_id', 'id');
    }

    public function userAgent(){
        return $this->hasMany(UserAgent::class,'user_id','id');
    }

    public function getTotalKey() {
        return $this->userAgent()->groupBy('keyVersion');
    }
}

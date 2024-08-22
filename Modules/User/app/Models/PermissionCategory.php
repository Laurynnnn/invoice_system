<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Database\Factories\PermissionCategoryFactory;
use Spatie\Permission\Models\Permission;

class PermissionCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'category_id');
    }

    // protected static function newFactory(): PermissionCategoryFactory
    // {
    //     //return PermissionCategoryFactory::new();
    // }
}

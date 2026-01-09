<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public const ADMIN = 1;
    public const USER = 2;
    public const KADES = 3;
    public const RT_RW = 4;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class AllData extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'all_data';
    protected $fillable = ['id','credential_number','name','class','position','birthdate','status','created_at','updated_at'];
}

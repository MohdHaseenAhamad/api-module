<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'gur_student';
    protected $fillable = [
        'usr_name','usr_email','usr_phone','usr_status'
    ];
}

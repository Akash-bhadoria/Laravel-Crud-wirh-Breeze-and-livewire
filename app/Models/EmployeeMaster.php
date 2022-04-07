<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMaster extends Model
{
    use HasFactory;

    public $timestamps = true;

     public $userstamps = true;


    protected $guarded=[];

    public function user(){
        return $this->hasOne(User::class,'id','employee_created_by');

    }

}

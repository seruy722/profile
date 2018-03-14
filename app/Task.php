<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['surname','name','email','phone','card_of_bank','comment','file_name','genre','sex','day'];
}

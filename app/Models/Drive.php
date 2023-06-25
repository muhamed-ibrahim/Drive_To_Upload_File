<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drive extends Model
{
    protected $table = 'drives';
    //    protected $filable = ['title','discribtion','file','userId'];
    protected $guarded = [];

    use HasFactory;
}

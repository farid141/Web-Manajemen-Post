<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //untuk dapat memasukkan beberapa field sekaligus ke database
    //pada command line
    protected $fillable = ['title', 'excerpt', 'body', 'slug'];

    //untuk memproteksi field agar tidak dapat diisi secara langsung
    //protected $guarded = ['id'];
}

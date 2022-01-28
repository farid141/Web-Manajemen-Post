<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //untuk dapat memasukkan beberapa field sekaligus ke database
    //pada command line
    protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id'];
    protected $with = ['category', 'author'];

    //untuk memproteksi field agar tidak dapat diisi secara langsung
    //protected $guarded = ['id'];

    //eager loading melakukan query untuk menyimpan seluruh row melalui
    //query yang lebih sedikit
    //sedangkan lazy eager loading dilakukan pada route yang menggunakan binding

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

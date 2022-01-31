<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //fitur laravel local scope
    public function scopeFilter($query, array $filters)
    {
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        //mempersingkat fungsi if
        //when akan mejalankan fungsi didalamnya jika argumen pertama bernilai true
        //?? (null coalescing operator) akan menggantikan isset null 
        //when merupakan method laravel, jika sebuah collection memiliki isi
        //maka akan dijalankan fungsi didalamnya
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
            return $query->whereHas('author', function ($query) use ($author) {
                $query->where('username', $author);
            });
        });
    }

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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

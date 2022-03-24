<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // model menggunakan factory agar dapat menggenerate data
    // trait
    use HasFactory;
    use Sluggable;


    //fitur laravel local scope....

    public function scopeFilter($query, array $filters)
    {
        // when(true, fungsi callback/closure)
        // (a??b), jika a benar, pilih A.jika salah, pilih b
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

    protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id', 'user_id', 'image'];

    // with digunakan untuk eager loading agar tidak perlu menuliskannya pada controller
    protected $with = ['category', 'author'];

    // lazy loading terjadi pada eloquent relationships
    //eager loading melakukan query untuk menyimpan seluruh row melalui
    //query yang lebih sedikit
    //sedangkan lazy eager loading dilakukan pada route yang menggunakan binding

    // static:: digunakan untuk mengakses fungsi statis, sedangkan self:: digunakan untuk
    // mengakses property statis

    // kita dapat memanggil field model yang berelasi dengan model lain
    // code dibawah akan mengembalikan baris tabel categories yang memiliki
    // id yang sama dengan category_id pada tabel post
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        // user_id digunakan untuk menggantikan author_id secara default untuk model binding
        return $this->belongsTo(User::class, 'user_id');
    }

    // untuk route model binding menggunakan field slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        // menggenerate field slug dan mengambil sumber dari field title pada view
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

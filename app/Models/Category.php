<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// kita dapat membuat baris baru dengan perintah new model  
// jika kita meletakkan model pada folder Models, 
// ketika membuat objek sesuai nama model, akan terpilih sacara otomatis
// sesuai dengan nama class model
// kemudian mengisikan masing masing field terhadap object tersebut
// terakhir jalankan perintah object->save()
// sedangkan object->all() mengembalikan array collection 
// sehingga dapat dengan mudah memfilter indeksnya 

// selain dengan cara tersebut, kita dapat menambahkan baris baru
// dengan mess assignment mencakup seluruh operasi CRUD
// nama_model::operasi_CRUD(). atau menambah filter sebelum CRUD
// Dengan cara ini, kita harus mengisi property fillable atau guarded 
// untuk mengatasi mess assignment (mana field yang boleh diisi mana yang tidak)
// guarded: field mana yang tidak boleh diisi
// fillable: field mana yang boleh diisi


// ketika kita mencetak text yang memiliki tag html, kita dapat menggunakan 
// blade command {!!  !!} agar script html berjalan dan tampilannya sesuai

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

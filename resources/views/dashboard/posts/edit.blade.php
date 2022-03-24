@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex -justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Edit Post</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/posts/{{ $post->slug }}" class="mb-3" enctype="multipart/form-data">
            {{-- method put digunakan untuk melakukan edit melalui model  --}}
            {{-- macam method dapat dilihat pada perintah php artisan route:list --}}
            @method('put')

            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error ('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $post->title) }}">
              {{-- old(nilai input, nilai database) --}}
              @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $post->slug) }}">
              @error('slug')
                  <div class="is-invalid">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <select class="form-select" name="category_id">
                @foreach ($categories as $category)
                {{-- operasi === mengecek tipe data --}}
                {{-- sedangkan == tidak --}}
                @if (old('category_id', $post->category_id) == $category->id)
                {{-- mempertahankan nilai sebelumnya jika terjadi error --}}
                    <option value="{{ $category->id }}" selected> {{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
              </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>

                <input type="hidden" name="oldImage" value="{{ $post->image }}">
                
                {{-- kalau ada image, pakai gambar lama, kalau baru tampilkan dengan js melalui classnya --}}
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif

                {{-- kalau ada perubahan pada form upload maka memanggil method preview image  --}}
                <input class="form-control @error ('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                {{-- image tidak menggunakan old (jika error maka harus menginputkan manual kembali) dikarenakan akan mencetak direktori 
                    (alasan keamanan) --}}

                @error('image')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
            </div>

            <div class="mb-3">
              <label for="body" class="form-label">Body</label>
              @error('body')
              <p class="text-danger">{{ $message }}</p>
              @enderror
                <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                <trix-editor input="body"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Edit Post</button>
          </form>
    </div>

    <script>
        // script untuk menggenerate slug berdasarkan title yang dimasukkan
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function () {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response=>response.json())
            .then(data=>slug.value=data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function previewImage() { 
            const image= document.querySelector('#image');
            const imgPreview= document.querySelector('.img-preview');

            imgPreview.style.display='block';

            const oFReader=new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

    </script>

@endsection
@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex -justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Create New Post</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/posts" class="mb-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error ('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
              @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>

            {{-- menggunakan sluggable --}}
            {{-- update model yang membutuhkan slug --}}
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
              @error('slug')
                  <div class="invalid-feedback">
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
                    @if (old('category_id') == $category->id)
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
                
                <img class="img-preview img-fluid mb-3 col-sm-5">
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
                <label for="image" class="form-label">Post Image</label>
                
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error ('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                {{-- image tidak menggunakan old (jika error maka harus menginputkan manual kembali) dikarenakan akan mencetak direktori 
                    (alasan keamanan) --}}

                @error('image')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
            </div>
            

            {{-- trix editor --}}
            {{-- dilakukan dengna mengincludekan trix.css&js  --}}
            </div>
            <div class="mb-3">
              <label for="body" class="form-label">Body</label>
              @error('body')
              <p class="text-danger">{{ $message }}</p>
              @enderror
                <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                <trix-editor input="body"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
          </form>
    </div>

    <script>
        // javascript untuk menggenerate slug
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function () {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response=>response.json())
            .then(data=>slug.value=data.slug)
        });

        // mencegah file upload pada trix editor
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        // image preview

        function previewImage() { 
            const image= document.querySelector('#image');
            const imgPreview= document.querySelector('.img-preview');

            // mengatur style dari imgPreview
            imgPreview.style.display='block';

            const oFReader=new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

@endsection
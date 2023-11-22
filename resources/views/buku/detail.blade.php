<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link href="{{ asset('dist/css/lightbox.min.css') }}" rel="stylesheet">
<div class="max-w-7xl mt-5 mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-6 dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <h4>Detail Buku</h4><br>
        <div class="container">
            <p>Judul : <b>{{$buku->judul}}</b></p>
            <p>Penulis : <b>{{$buku->penulis}}</b></p>
            <p>Harga : <b>{{$buku->harga}}</b></p><br>
            <h4>Galeri</h4><br>
            <div class="row">
                @foreach ($buku->galeri()->get() as $item)
                <div class="col-md-4">
                <a href="{{ asset($item->path)}}" data-lightbox="image-1">
                    <img class='object-cover object-center mb-1'
                        src='{{ $item->path }}'
                        style="width: 240px; height: 240px;">
                </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('dist/js/lightbox-plus-jquery.min.js') }}"></script>
</x-app-layout>
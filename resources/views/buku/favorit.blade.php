<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buku Favorit') }}
        </h2>
    </x-slot>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<div class="container mt-3">
    <div class="row">
    @foreach($favoritedBooks as $favorit)
    <div class="col-md-6 col-lg-4 col-xl-3 p-6 ">
        <div class="bg-white p-3 pb-1 dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <div>
                @if ($favorit->buku->filepath)
                        <img class="object-cover object-center"
                            src="{{ $favorit->buku->filepath }}" style="width: 100%; height: 300px;"><br>
                    @endif
                <a href="{{route('galeri.buku', $favorit->buku->id)}}" style="color:black; text-decoration: none;">
                    <h4>{{ $favorit->buku->judul }}</h4></a>
                <span style="color:orange;">★</span> 
                        @php
                            $averageRating = $favorit->buku->rating()->avg('rating');
                        @endphp
                        @if ($averageRating !== null)
                            {{ number_format($averageRating, 1) }}
                        @else
                            <span style="color:grey;">belum dinilai</span>
                        @endif
                <p>{{ $favorit->buku->penulis }}</p>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>
</x-app-layout>
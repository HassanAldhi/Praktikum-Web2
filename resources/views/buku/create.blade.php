<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<div class="container my-5">
    <h4>Tambah Buku</h4>
    @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    <form action="{{ route('buku.store') }}" method="POST">
        @csrf 
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul">
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga">
        </div>
        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tgl. Terbit</label>
            <input type="date" class="date form-control" id="tgl_terbit" name="tgl_terbit">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/buku" class="btn btn-danger">Batal</a>
    </form>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<div style="padding: 20px 100px;">
    <table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tgl. Terbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_buku as $buku)
        <tr>
            <td>{{ $buku->id }}</td>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->penulis }}</td>
            <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
            <td>{{ date('d/m/Y', strtotime($buku->tgl_terbit)) }}</td>
            <td>
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>    
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div class="d-flex gap-5 ">
        <p><b>Jumlah Buku :</b> {{$jumlah_buku}}</p>
        <p><b>Total Harga :</b> {{ "Rp ".number_format($total, 2, ',', '.') }}</p>
    </div>
</div>
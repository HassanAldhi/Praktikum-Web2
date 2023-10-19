<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Daftar Buku</title>
</head>
<body>
    <div class="container" style="padding: 20px;">
    @if(Session::has('pesan'))
        <div class="alert alert-success">{{Session::get('pesan')}}</div>
    @endif
    
    @if(Session::has('pesanDelete'))
        <div class="alert alert-danger">{{Session::get('pesanDelete')}}</div>
    @endif

    @if(count($data_buku))
        <div class="alert alert-success">Ditemukan <strong>{{count($data_buku)}}</strong> <strong>data dengan kata : </strong> {{$cari}} </div>
    @else
        <div class="alert alert-warning"><h4>Data {{$cari}} tidak ditemukan </h4></div>
        <a href="/buku" class="btn btn-warning">kembali</a>
    @endif
        
        <form action="{{ route('buku.search')}}" method="get">
            @csrf
            <input type="text" name="kata" class="form-control" placeholder="cari...." 
            style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float:right;" >
        </form>
        
        <a href="{{ route('buku.create')}}" class="btn btn-primary">Tambah Buku</a>
        <table class="table my-3">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tgl. Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                <tr>
                    <th scope="row">{{ ($data_buku->currentPage() - 1) * $data_buku->perPage() + $loop->index + 1 }}</th>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                    <td class="d-flex">
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary me-1" href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                            <button type="submit" class="btn btn-danger" onclick="confirmDelete('{{ $buku->judul }}')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$data_buku->links()}}
        <div class="d-flex gap-5">
            <p><b>Jumlah Buku :</b> {{$jumlah_buku}}</p>
            <p><b>Total Harga :</b> {{ "Rp ".number_format($total, 2, ',', '.') }}</p>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Yakin mau menghapus buku dengan ID ' + id + '?')) {
                document.forms['delete-form-' + id].submit();
            }
        }
    </script>
</body>
</html>

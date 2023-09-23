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
        <a href="{{ route('buku.create')}}" class="btn btn-primary">Tambah Buku</a>
        <table class="table my-3">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
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
                    <td>{{ $buku->id }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ date('d/m/Y', strtotime($buku->tgl_terbit)) }}</td>
                    <td class="d-flex">
                        <a class="btn btn-primary me-1" href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $buku->id }}')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

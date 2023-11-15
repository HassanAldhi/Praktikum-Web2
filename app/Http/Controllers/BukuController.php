<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Galeri;
use Intervention\Image\Facades\Image;

class BukuController extends Controller
{
    public function index(){
        $batas = 5;
        $data_buku = Buku::orderBy('id','desc')->paginate($batas);
        $jumlah_buku = Buku::count();
        $total = Buku::sum('harga');

        return view('dashboard', compact('data_buku','jumlah_buku','total'));
    }
     public function create(){
        return view('buku.create');
     }

     public function store(Request $request)
     {
         $this->validate($request, [
             'judul' => 'required|string',
             'penulis' => 'required|string|max:30',
             'harga' => 'required|numeric|min:500',
             'tgl_terbit' => 'required|date',
         ]);
 
         $fileName = 'default_thumbnail.png';
         $filePath = 'uploads/default_thumbnail.png';
         if ($request->hasFile('thumbnail')) {
             $request->validate([
                 'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048'
             ]);
             $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
             $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
             Image::make(storage_path().'/app/public/uploads/'.$fileName)->fit(240, 320)->save();
         }
         $buku = Buku::create([
             'judul' => $request->judul,
             'penulis' => $request->penulis,
             'harga' => $request->harga,
             'tgl_terbit' => $request->tgl_terbit,
             'filename' => $fileName,
             'filepath' => '/storage/'.$filePath
         ]);
 
         if ($request->file('galeri')) {
             foreach ($request->file('galeri') as $key=>$file) {
                 $fileName = time().'_'.$file->getClientOriginalName();
                 $filePath = $file->storeAs('uploads', $fileName, 'public');
                 $galeri = Galeri::create([
                     'nama_galeri' => $fileName,
                     'path' => '/storage/'.$filePath,
                     'foto' => $fileName,
                     'buku_id' => $buku->id
                 ]);
             }
         }
         return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan!');
     }

     public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesanDelete', 'Data buku berhasil di hapus');
    }

    public function galeriDestroy($id){
        $galeri = Galeri::find($id);
        $galeri->delete();
        return redirect()->back()->with('pesan', 'Gambar Galeri Berhasil Dihapus!');
    }

    public function edit($id){
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, string $id){
        $buku = Buku::find($id);

        if ($request->hasFile('thumbnail')){
            $request->validate([
                'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
            ]);
    
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads',$fileName, 'public');
    
            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(480,640)
                ->save();
            $buku->update([
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath]);
        
        }

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
        ]);

        if ($request->file('galeri')){
            foreach($request->file('galeri') as $key => $file){
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $galeri = Galeri::create([
                    'nama_galeri' => $fileName,
                    'path'        => '/storage/' . $filePath,
                    'foto'        => $fileName,
                    'buku_id'     => $id
                ]);
            }
        }

        return redirect('/buku')->with('pesan', 'Data buku berhasil di edit');;
    }

    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul','like',"%".$cari."%")->orwhere('penulis','like',"%".$cari."%")->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $total = Buku::sum('harga');
        return view('buku.search', compact('jumlah_buku','total','data_buku','cari'));
    }

}

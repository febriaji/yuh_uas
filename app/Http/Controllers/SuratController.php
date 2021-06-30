<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\List_;
use App\Models\Gambar;
use PDF;

class SuratController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function list()
    {
        $hasil = DB::select('select * from pegawai');
        return view('list-pegawai', ['data' => $hasil]);
    }

    public function tambah(){
        $gambar = Gambar::get();
        return view('tambah',['gambar' => $gambar]);
        //return view('tambah_surat');
    }


    public function simpan(Request $req)
    {
        $this->validate($req, [
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'nip' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);
 
        // menyimpan data file yang diupload ke variabel $file
        $file = $req->file('file');
 
        $nama_file = time()."_".$file->getClientOriginalName();
 
                // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload,$nama_file);


        DB::insert(
            'insert into pegawai (nip, nama, alamat, file) values (?, ?, ?, ?)',
            [$req->nip, $req->nama, $req->alamat, $nama_file]
        );
        $hasil = DB::table('pegawai')->paginate(10);
        return view('list-pegawai', ['data' => $hasil]);
    }
    public function hapus($req)
    {
        Log::info('proses hapus dengan id=' . $req);
        DB::delete('delete from pegawai where id = ?', [$req]);

        $hasil = DB::select('select * from pegawai');
        return view('list-pegawai', ['data' => $hasil]);
    }
    public function ubah($req)
    {
        $hasil = DB::select('select * from pegawai where id = ?', [$req]);
        return view('form-ubah', ['data' => $hasil]);
    }
    public function rubah(Request $req)
    {
        Log::info('Hallo');
        Log::info($req);
        DB::update(
            'update pegawai set ' .
                'nip=?, ' .
                'nama=?, ' .
                'alamat=?',
            [
                $req->nip,
                $req->nama,
                $req->alamat,
            
                $req->id
            ]
        );
        $hasil = DB::select('select * from pegawai');
        return view('list-pegawai', ['data' => $hasil]);
    }

        public function cetak()
    {
        set_time_limit(300);
        // $pegawai = Gambar::all();
 
        // $pdf = PDF::loadview('pegawai_pdf',['pegawai'=>$pegawai]);
        $pegawai = Gambar::all();
        $pdf = PDF::loadview('data-pdf',['pegawai'=>$pegawai]);
       
        return $pdf->stream();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\List_;
use App\Models\Gambar;
use PDF;

class PegController extends Controller
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
        return view('tambah_surat',['gambar' => $gambar]);
        //return view('tambah_surat');
    }


    public function simpan(Request $req)
    {
        $this->validate($req, [
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'judul_surat' => 'required',
        ]);
 
        // menyimpan data file yang diupload ke variabel $file
        $file = $req->file('file');
 
        $nama_file = time()."_".$file->getClientOriginalName();
 
                // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload,$nama_file);


        DB::insert(
            'insert into surat (nomor_surat, tanggal_surat, judul_surat, file) values (?, ?, ?, ?)',
            [$req->nomor_surat, $req->tanggal_surat, $req->judul_surat, $nama_file]
        );
        $hasil = DB::table('surat')->paginate(10);
        return view('list-surat', ['data' => $hasil]);
    }
    public function hapus($req)
    {
        Log::info('proses hapus dengan id=' . $req);
        DB::delete('delete from surat where id = ?', [$req]);

        $hasil = DB::select('select * from surat');
        return view('list-surat', ['data' => $hasil]);
    }
    public function ubah($req)
    {
        $hasil = DB::select('select * from surat where id = ?', [$req]);
        return view('form-ubah', ['data' => $hasil]);
    }
    public function rubah(Request $req)
    {
        Log::info('Hallo');
        Log::info($req);
        DB::update(
            'update surat set ' .
                'nomor_surat=?, ' .
                'tanggal_surat=?, ' .
                'judul_surat=? where id=? ',
            [
                $req->nomor_surat,
                $req->tanggal_surat,
                $req->judul_surat,
                $req->id
            ]
        );
        $hasil = DB::select('select * from surat');
        return view('list-surat', ['data' => $hasil]);
    }

        public function cetak()
    {
        set_time_limit(300);
        // $pegawai = Gambar::all();
 
        // $pdf = PDF::loadview('pegawai_pdf',['pegawai'=>$pegawai]);
        $surat = Gambar::all();
        $pdf = PDF::loadview('data-pdf',['surat'=>$surat]);
       
        return $pdf->stream();
    }
}

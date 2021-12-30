<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Pengaturan;

class UserController extends Controller
{
    public function index() 
    {
        return view('user.index');
    }

    public function log()
    {
        return view('user.index');
    }

    public function register()
    {
        return view('user.register');
    }

    public function home()
    {
        $user = \Session::get('user');
        $produk = Produk::paginate(4);
        $data = Pengaturan::find(1);


        return view('user.home', [ 'produk' => $produk, 'data' => $data]);
    }

    public function profil()
    {
        $data = Pengaturan::find(1);
        
        return view('user.profil', ['data' => $data]);
    }

    public function katalogPria(Request $request)
    {
        $user = \Session::get('user');
        $data = Pengaturan::find(1);

        if ($request->has('cari')) {
            $produk = Produk::where('nama_produk', 'LIKE', '%'.$request->cari.'%')->paginate(8);
        } else {
            $produk = Produk::where('kategori', 'pria')->paginate(8);
        }

        return view('user.katalog_pria', [ 'produk' => $produk, 'data' => $data]);
    }

    public function katalogWanita(Request $request)
    { 
        $user = \Session::get('user');
        $data = Pengaturan::find(1);

        if ($request->has('cari')) {
            $produk = Produk::where('nama_produk', 'LIKE', '%'.$request->cari.'%')->paginate(8);
        } else {
            $produk = Produk::where('kategori', 'wanita')->paginate(8);
        }
        

        return view('user.katalog_wanita', [ 'produk' => $produk, 'data' => $data]);
    }

    public function detail_produk($id)
    {
        $user = \Session::get('user');
        $data = Pengaturan::find(1);
        $produk = Produk::find($id);

        $user = User::get()->where('email', $user->email)->first();

        return view('user.detail_produk', ['data' => $data, 'produk' => $produk, 'user' => $user]);
    }

    public function keranjang()
    {
        $user = \Session::get('user');
        $data = Pengaturan::find(1);
        $user = User::get()->where('email', $user->email)->first();
        $keranjang = Keranjang::where('customer_id', $user->id)->get();
        $p = $keranjang->count();
        // dd($p);
        return view('user.keranjang', ['data' => $data, 'keranjang' => $keranjang, 'user' => $user, 'p' => $p]);
    }

    public function add_keranjang(Request $request)
    {
        $keranjang = $request->all();
        Keranjang::create($keranjang);
        // dd($keranjang);
        \Session::flash('keranjang', 'Berhasil Di Tambahkan!');

        return back(); 
    }

    public function hapusKeranjang($id)
    {
        $keranjang = Keranjang::find($id);
        $keranjang->delete();

        return back();
    }

    public function add_pesanan(Request $request)
    {
        $request->validate([
            'jumlah' => 'required'
        ]);
        
        $pesanan = Pesanan::create([
            'code_pesanan' => 'PES'.rand(0,100000000),
            'customer_id' => $request->customer_id,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'harga' => \Str::of($request->total)->replaceMatches('/,.*|\D/', ''),
            'pemesan' => $request->pemesan,
            'no_hp' => '0'.$request->no_hp,
            'alamat' => $request->alamat,
            'status_pembayaran' => 'Belum Bayar',
            'bukti_pembayaran' => '',
            'keterangan' => 'Pending',
            'gambar' => $request->gambar,
        ]);


        \Session::flash('msg', 'Berhasil Di Pesan! Silahkan Upload Bukti Pembayaran');

        $keranjang = Keranjang::find($request->id);
        $keranjang->delete();



        return back();
    }

    public function dashboard_user()
    {
        $user = \Session::get('user');
        $data = Pengaturan::find(1);
        $user = User::get()->where('email', $user->email)->first();
        $pesanan = Pesanan::where('customer_id', $user->id)->get();

        return view('user.dashboard', ['data' => $data, 'pesanan' => $pesanan, 'user' => $user]);
    }

    public function detail_pesanan($id)
    {
        $user = \Session::get('user');
        $data = Pengaturan::find(1);
        $user = User::get()->where('email', $user->email)->first();
        $pesanan = Pesanan::find($id);

        return view('user.detail_pesanan', ['data' => $data, 'pesanan' => $pesanan, 'user' => $user]);
    }

    public function pembayaran_user($id)
    {
        $pesanan = Pesanan::find($id);
        $data = Pengaturan::find(1);
        // dd($data);
        return view('user.pembayaran', ['data' => $data, 'pesanan' => $pesanan]);
    }

    public function addPembayaran(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,png,jpeg|max:4048',
        ]);

        $namaGambar = $request->bukti_pembayaran->getClientOriginalName(). '-'. time(). '.' .$request->bukti_pembayaran->extension();

        $request->bukti_pembayaran->move(public_path('gambar/pembayaran'), $namaGambar);

        $pesanan = Pesanan::where('id',$request->id)->update([

            'bukti_pembayaran' => $namaGambar,
            'status_pembayaran' => 'Sudah Bayar',
        ]);

        \Session::flash('bayar', 'Pembayaran Berhasil!');

        return back();
    }

    public function konfirDiterima(Request $request)
    {
        $pesanan = Pesanan::where('id',$request->id)->update([

            'keterangan' => 'Diterima',
        ]);

        \Session::flash('terima', 'Pesanan Sudah Diterima!');

        return back();
    }

    public function edit_profil($id)
    {
        $user = User::find($id);
        $data = Pengaturan::find(1);

        return view('user.edit_profil', ['data' => $data, 'user' => $user]);
    }

    public function editProfil(Request $request)
    {
        $user = User::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => '0'.$request->no_hp,
        ]);

        \Session::flash('editProfil', 'Data Telah Di Update!');
        return back();
    }
}

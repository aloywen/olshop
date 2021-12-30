<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Riwayat;
use App\Models\Pengaturan;
use App\Models\User;


class AdminController extends Controller
{
    public function dashboard()
    {
        $data = Pengaturan::find(1);
        $produk = Produk::get()->count();
        $user = User::where('role', 'customer')->get()->count();
        $admin = User::where('role', 'admin')->get()->count();
        $pesanan = Pesanan::get()->count();
        return view('admin.dashboard', ['data' => $data, 'produk' => $produk, 'user' => $user, 'pesanan' => $pesanan, 'admin' => $admin]);
    }
    public function produk()
    {
        $produk = Produk::get();
        $data = Pengaturan::find(1);

        return view('admin.produk', ['produk' => $produk, 'data' => $data]);
    }

    public function tambah_produk()
    {
        $data = Pengaturan::find(1);
        return view('admin.tambah_produk', ['data' => $data]);
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->all());
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,png,jpeg|max:4048',
            'nama_produk' => 'required|max:100',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'kategori' => 'required'
        ]);

        $namaGambar = $request->gambar->getClientOriginalName(). '-'. time(). '.' .$request->gambar->extension();

        $request->gambar->move(public_path('gambar/produk'), $namaGambar);

        // dd($namaGambar);
 
        $store = new Produk;
        $store->nama_produk = $request->nama_produk;
        $store->deskripsi = $request->deskripsi;
        $store->harga = $request->harga;
        $store->stok = $request->stok;
        $store->kategori = $request->kategori;
        $store->gambar = $namaGambar;
        $store->save();

        \Session::flash('Produk', 'Data Telah DiTambah!');
        return redirect('/produk'); 
    }

    public function edit_produk($id)
    {
        $produk = Produk::find($id);
        $data = Pengaturan::find(1);

        return view('admin.edit_produk', ['produk' => $produk, 'data' => $data]);
    }

    public function editProduk(Request $request, $id)
    {
        // $attr = $request->except(['_method','_token','old']);
        
        $request->validate([
            'gambar' => 'image|mimes:jpg,png,jpeg|max:4048',
            'nama_produk' => 'required|max:100',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'kategori' => 'required'
        ]);
        
        if($request->gambar){
            $namaGambar = $request->gambar->getClientOriginalName(). '-'. time(). '.' .$request->gambar->extension();
            $request->gambar->move(public_path('gambar/produk'), $namaGambar);
            $gambar = $namaGambar;
            \File::delete($request->old);
            
        } else {
            $gambar = $request->old;
        }
        
        $produk = Produk::where('id',$request->id)->update([
            'gambar' => $gambar,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori
        ]);
        // dd($produk);
        
        \Session::flash('editProduk', 'Data Telah Di Update!');
        return redirect('/produk');
    }

    public function hapusProduk($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return back();
    }

    public function pemesanan()
    {
        $pesanan = Pesanan::get();
        $data = Pengaturan::find(1);

        return view('admin.pemesanan', ['pemesanan' => $pesanan, 'data' => $data]);
    }

    public function detail_pemesanan($id)
    {
        $pesanan = Pesanan::find($id);
        $data = Pengaturan::find(1);

        return view('admin.detail_pemesanan', ['pesanan' => $pesanan, 'data' => $data]);
    }

    public function pembayaran()
    {
        $pembayaran = Pesanan::get();
        $data = Pengaturan::find(1);

        return view('admin.pembayaran', ['pembayaran' => $pembayaran, 'data' => $data]);
    }

    public function prosesPembayaran(Request $request, $id)
    {
        $konfir = Pesanan::where('id',$id)->update([
            'keterangan' => 'Proses Packing',
        ]);

        \Session::flash('bayar', 'Berhasil Diproses!');

        return back();
    }

    public function prosesPengiriman(Request $request, $id)
    {
        $konfir = Pesanan::where('id',$id)->update([
            'keterangan' => 'Kirim',
        ]);

        \Session::flash('kirim', 'Berhasil Diproses Kirim!');

        return back();
    }

    public function riwayat()
    {
        $riwayat = Pesanan::get();
        $data = Pengaturan::find(1);

        return view('admin.riwayat', ['riwayat' => $riwayat, 'data' => $data]);
    }

    public function detail_riwayat($code_pesanan)
    {
        $riwayat = Pesanan::where('code_pesanan',$code_pesanan)->first();
        $data = Pengaturan::find(1);
        // dd($riwayat);
        return view('admin.detail_riwayat', ['riwayat' => $riwayat, 'data' => $data]);
    }

    public function pengaturan()
    {
        
        $data = Pengaturan::find(1);
        $admin = User::where('role', 'admin')->get();

        $warna = ['bg-danger','bg-warning','bg-success','bg-primary','bg-info','bg-purple',];

        return view('admin.pengaturan', ['warna' => $warna, 'data' => $data, 'admin' => $admin]);
    }

    public function addPengaturan(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpg,png,jpeg|max:4048',
            'nama_web' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'warna_web' => 'required',
            'tentang' => 'required',
            'tentang2' => 'required',
            'tentang3' => 'required'
        ]);

        if($request->logo){
            $namalogo = $request->logo->getClientOriginalName(). '-'. time(). '.' .$request->logo->extension();
            $request->logo->move(public_path('gambar/banner'), $namalogo);
            $gambar = $namalogo;
            \File::delete($request->old);
            
        } else {
            $gambar = $request->old;
        }

        $user = Pengaturan::where('id',1)->update([
            'nama_web' => $request->nama_web,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'logo' => $gambar,
            'warna_web' => $request->warna_web,
            'tentang' => $request->tentang,
            'tentang2' => $request->tentang2,
            'tentang3' => $request->tentang3,
        ]);

        \Session::flash('web', 'Berhasil Di Ubah!');
        return redirect('/pengaturan');
    }

    public function admin()
    {
        $data = Pengaturan::find(1);

        return view('admin.admin', ['data' => $data])
;    }

    public function addAdmin(Request $request)
    {
        $attr = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $attr['role'] = 'admin';
        $attr['password'] = \Hash::make($request->password);
        // dd($attr);
        User::create($attr);

        \Session::flash('admin', 'Berhasil mambahkan admin!');
        return redirect('/pengaturan');
    }

    public function deleteAdmin($id)
    {
        $user = User::find($id);
        $user->delete();

        \Session::flash('hps', 'Data admin berhasil dihapus');
        return back();
    }

}

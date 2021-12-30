@extends('admin.layout.app')
@section('title', 'Pengaturan Web')

@section('content')


@if (Session::has('web'))
<div class="row">
    <div class="col-sm-4">

        <div class="alert alert-success" role="alert">
            {{Session::get('web')}}
        </div>
    </div>
</div>
@endif

@if (Session::has('admin'))
<div class="row">
    <div class="col-sm-4">

        <div class="alert alert-success" role="alert">
            {{Session::get('admin')}}
        </div>
    </div>
</div>
@endif

@if (Session::has('hps'))
<div class="row">
    <div class="col-sm-4">

        <div class="alert alert-success" role="alert">
            {{Session::get('hps')}}
        </div>
    </div>
</div>
@endif

<section class="section">
    <div class="section-header">
        <h1>Pengaturan Web</h1>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <p class="text-center h4 mb-3">Halaman Website</p>
                <form action="/addPengaturan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="nama_web" class="col-sm-2 col-form-label">Nama Website</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nama_web" value="{{$data->nama_web}}"
                                name="nama_web">
                        </div>
                        @error('nama_web')
                        <div class="text-danger">Tidak Boleh Kosong</div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="alamat" value="{{$data->alamat}}"
                                name="alamat">
                        </div>
                        @error('alamat')
                        <div class="text-danger">Tidak Boleh Kosong</div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="no_hp" class="col-sm-2 col-form-label">No handphone</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="no_hp" value="{{$data->no_hp}}"
                                name="no_hp">
                        </div>
                        @error('no_hp')
                        <div class="text-danger">Tidak Boleh Kosong</div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="logo" class="col-sm-2 col-form-label">Logo Website</label>
                        <div class="col-sm-4">
                            <img src="/gambar/banner/{{$data->logo}}" width="90" height="90">
                            <input type="hidden" class="form-control" id="old" name="old" value="{{$data->logo}}">
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>
                        @error('logo')
                        <div class="text-danger">Tidak Boleh Kosong</div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="warna_web" class="col-sm-2 col-form-label">Warna Website</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="warna_web">

                                <option selected>{{$data->warna_web}}</option>
                                @foreach ($warna as $w)

                                <option value="{{$w}}">{{$w}}</option>

                                @endforeach
                            </select>
                        </div>
                        @error('warna_web')
                        <div class="text-danger">Tidak Boleh Kosong</div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="tentang" class="col-sm-2 col-form-label">Tentang Perusahaan</label>
                        <div class="col-sm-4">
                            <textarea name="tentang" id="tentang" cols="80" rows="10">{{$data->tentang}}</textarea>
                        </div>
                        @error('tentang')
                        <div class="text-danger">Tidak Boleh Kosong</div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="tentang2" class="col-sm-2 col-form-label">Tentang Perusahaan</label>
                        <div class="col-sm-4">
                            <textarea name="tentang2" id="tentang2" cols="80" rows="10">{{$data->tentang2}}</textarea>
                        </div>
                        @error('tentang2')
                        <div class="text-danger">Tidak Boleh Kosong</div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="tentang3" class="col-sm-2 col-form-label">Tentang Perusahaan</label>
                        <div class="col-sm-4">
                            <textarea name="tentang3" id="tentang3" cols="80" rows="10">{{$data->tentang3}}</textarea>
                        </div>
                        @error('tentang3')
                        <div class="text-danger">Tidak Boleh Kosong</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <a href="/produk"><button class="btn btn-danger mt-2">Kembali</button></a>


                <p class="text-center h4 my-3">Data Admin</p>

                <a href="/admin">
                    <div class="btn btn-primary mb-3">Tambah Admin</div>
                </a>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=0 @endphp
                        @foreach ($admin as $p)
                        @php $no++ @endphp
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->email}}</td>
                            <td>
                                <form action="/deleteAdmin/{{$p->id}}" method="POST"> @csrf @method("delete")
                                    <button type="submit" onclick="alert('yakin ingin menghapusnya?')"
                                        class="badge bg-danger">
                                        Hapus
                                    </button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>



@endsection
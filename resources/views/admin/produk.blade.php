@extends('admin.layout.app')
@section('title', 'List Produk')

@section('content')

@if (Session::has('Produk'))
<div class="alert alert-success" role="alert">
    {{Session::get('Produk')}}
</div>
@endif

@if (Session::has('editProduk'))
<div class="alert alert-success" role="alert">
    {{Session::get('editProduk')}}
</div>
@endif

<section class="section">
    <div class="section-header">
        <h1>List Produk</h1>
    </div>

    <a href="/tambah-produk"><button class="btn btn-primary mb-4">Tambah Data Produk</button></a>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=0 @endphp
                        @foreach ($produk as $p)
                        @php $no++ @endphp
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$p->nama_produk}}</td>
                            <td>@currency($p->harga)</td>
                            <td>{{$p->stok}}</td>
                            <td>{{$p->kategori}}</td>
                            <td><img src="/gambar/produk/{{$p->gambar}}" alt="" width="80" height="80"></td>
                            <td>
                                <a href="/edit-produk/{{ $p->id }}">
                                    <span class="badge bg-warning">Edit</span>
                                </a>
                                <form action="/hapus-produk/{{$p->id}}" method="POST"> @csrf @method("delete") <button
                                        type="submit" onclick="alert('yakin ingin menghapusnya?')"
                                        class="badge bg-danger">
                                        Hapus</button>

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
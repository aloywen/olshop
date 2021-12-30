@extends('user.layout.app')
@section('title', 'Dashboard')

@section('content')

@if (Session::has('msg'))
<div class="alert alert-info" role="alert">
    {{Session::get('msg')}}
</div>
@endif

<div class="container">



    <p class="h3 mb-5">Dashboard</p>

    <a href="/edit-profil/{{$user->id}}"><span class="badge bg-warning mb-3">Edit Profil</span></a>

    <div class="mb-3 row">
        <label class="col-sm-1 col-form-label">Nama</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" value="{{$user->name}}" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-1 col-form-label">Email</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" value="{{$user->email}}" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-1 col-form-label">Nomor HP</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" value="{{$user->no_hp}}" readonly>
        </div>
    </div>
    <div class="mb-5 row">
        <label class="col-sm-1 col-form-label">Alamat</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" value="{{$user->alamat}}" readonly>
        </div>
    </div>


    <p class="h3 mt-5 mb-3">Riwayat Pemesanan</p>

    <div class="d-flex flex-warp">
        @foreach ($pesanan as $p)
        <div class="card m-3" style="width: 18rem;">
            <img src="/gambar/produk/{{$p->gambar}}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{$p->nama_produk}}</h5>
                <h6 class="card-title">@currency($p->harga)</h6>
                <p><span
                        class="badge {{ $p->status_pembayaran == 'Belum Bayar' ? ' bg-danger' : 'bg-success'}}">{{$p->status_pembayaran}}</span>
                </p>
                <p><span class="badge 
                    {{ $p->keterangan == 'Diterima' ? ' bg-success' : ''}} 
                    {{ $p->keterangan == 'Kirim' ? ' bg-success' : ''}} 
                    {{ $p->keterangan == 'Proses Packing' ? ' bg-warning' : ''}} 
                    {{ $p->keterangan == 'Pending' ? ' bg-danger' : ''}}
                    ">{{$p->keterangan}}</span> {{$p->updated_at}}
                </p>
                <a href="/detail-pesanan/{{ $p->id }}" class="btn btn-primary">Detail</a>
            </div>
        </div>
        @endforeach
    </div>

</div>
{{-- <div class="card">
    <div class="card-body">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Pesanan</th>
                    <th>Jumlah Item</th>
                    <th>Total Bayar</th>
                    <th>Pembayaran</th>
                    <th>Keterangan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $no=0 @endphp
                @foreach ($pesanan as $p)
                @php $no++ @endphp
                <tr>
                    <td>{{$no}}</td>
<td>{{$p->created_at}}</td>
<td>{{$p->nama_produk}}</td>
<td>{{$p->jumlah}}</td>
<td>@currency($p->harga)</td>
<td><span class="badge bg-danger">{{$p->status_pembayaran}}</span></td>
<td><span class="badge bg-warning">{{$p->keterangan}}</span></td>
<td>
    <a href="/pembayaran-user/{{ $p->customer_id }}">
        <span class="badge bg-primary">bayar</span>
    </a>
</td>
<td>
    <a href="/detail-pending/{{ $p->id }}">
        <span class="badge bg-warning">Detail</span>
    </a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div> --}}


@endsection

<script>
    function myFunction() {
        let checkBox1 = document.getElementById("1");
        let checkBox = document.getElementById("2");
        let text = document.getElementById("button");

        if (checkBox1.checked && checkBox.checked == true){
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>
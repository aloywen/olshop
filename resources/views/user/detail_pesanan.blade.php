@extends('user.layout.app')
@section('title', 'Detail Pemesanan')

@section('content')

@if (Session::has('terima'))
<div class="alert alert-success" role="alert">
    {{Session::get('terima')}}
</div>
@endif

<p class="h3 mt-5 mb-3 text-center">Detail Pemesanan</p>

<div class="card mb-3 container" style="max-width: 590px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="/gambar/produk/{{$pesanan->gambar}}" class="img-fluid rounded-start" alt="...">
            @if ($pesanan->status_pembayaran == 'Belum Bayar')

            <a href="/pembayaran-user/{{ $pesanan->id }}" class="btn btn-primary m-5">Bayar</a>

            @endif

            @if ($pesanan->keterangan == 'Kirim')
            <form action="/konfirDiterima" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" value="{{$pesanan->id}}" name="id">
                <button type="submit" class="btn bg-purple text-white mt-3">konfirmasi Diterima</button>
            </form>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <p class="card-text">Tanggal Pemesanan : {{$pesanan->created_at}}</p>
                <h5 class="card-title">{{$pesanan->nama_produk}}</h5>
                <h5 class="card-title">Jumlah Pesanan : {{$pesanan->jumlah}}</h5>
                <p class="card-text"><small class="text-muted">@currency($pesanan->harga)</small></p>
                <p class="card-text">Status Pengiriman : <span class="badge 
                        {{ $pesanan->keterangan == 'Diterima' ? ' bg-success' : ''}} 
                    {{ $pesanan->keterangan == 'Kirim' ? ' bg-success' : ''}} 
                    {{ $pesanan->keterangan == 'Proses Packing' ? ' bg-warning' : ''}} 
                    {{ $pesanan->keterangan == 'Pending' ? ' bg-danger' : ''}}">{{$pesanan->keterangan}}</span>
                    <br>Pada
                    {{$pesanan->updated_at}}
                </p>
                <p class="card-text">Status Pembayaran : <span
                        class="badge {{ $pesanan->status_pembayaran == 'Belum Bayar' ? ' bg-danger' : 'bg-success'}}">{{$pesanan->status_pembayaran}}</span>
                </p>
            </div>
        </div>
    </div>
</div>



@endsection
@extends('admin.layout.app')
@section('title', 'Detail Pemesanan')

@section('content')

<section class="section">
    @if (Session::has('kirim'))
    <div class="row">
        <div class="col-sm-4">

            <div class="alert alert-success" role="alert">
                {{Session::get('kirim')}}
            </div>
        </div>
    </div>
    @endif

    <div class="section-header">
        <h1>List Pemesanan</h1>
    </div>


    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <div class="mb-3 row">
                    <label for="booking" class="col-sm-4 col-form-label">Tanggal Pemesanan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="booking" name="booking"
                            value="{{$pesanan->created_at}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="booking" class="col-sm-4 col-form-label">Pemesan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="booking" name="booking"
                            value="{{$pesanan->pemesan}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="booking" class="col-sm-4 col-form-label">Nama Produk</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="booking" name="booking"
                            value="{{$pesanan->nama_produk}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="booking" class="col-sm-4 col-form-label">Jumlah Pesanan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="booking" name="booking" value="{{$pesanan->jumlah}}"
                            readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="booking" class="col-sm-4 col-form-label">Total Bayar</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="booking" name="booking"
                            value="@currency($pesanan->harga)" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="booking" class="col-sm-4 col-form-label">Status Pembayaran</label>
                    <div class="col-sm-3">
                        <span
                            class="badge {{ $pesanan->status_pembayaran == 'Belum Bayar' ? ' bg-danger' : 'bg-success'}}">{{$pesanan->status_pembayaran}}</span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="booking" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-3">
                        <span
                            class="badge {{ $pesanan->keterangan == 'Diterima' ? ' bg-success' : ''}} 
                                {{ $pesanan->keterangan == 'Kirim' ? ' bg-success' : ''}} 
                                {{ $pesanan->keterangan == 'Proses Packing' ? ' bg-warning' : ''}} 
                                {{ $pesanan->keterangan == 'Pending' ? ' bg-danger' : ''}}">{{$pesanan->keterangan}}</span>
                    </div>
                </div>
                <form action="{{ route('pengiriman', $pesanan->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn bg-purple text-white"
                        {{ $pesanan->keterangan == 'Proses Packing' ? '' : 'disabled'}}>Kirim Barang</button>
                </form>
            </div>
        </div>
    </div>
</section>



@endsection
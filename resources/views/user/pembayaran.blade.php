@extends('user.layout.app')
@section('title', 'Pembayaran')

@section('content')

@if (Session::has('bayar'))
<div class="alert alert-success" role="alert">
    {{Session::get('bayar')}}
</div>
@endif

<p class="h3 mb-5 text-center mt-3">Pembayaran</p>

<div class="container">
    <form action="/addPembayaran" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3 row">
            <label class="col-sm-1 col-form-label">Upload</label>
            @if ($errors->has('bukti_pembayaran'))
            <p class="text-danger">{{$errors->first('bukti_pembayaran')}}</p>
            @endif
            <div class="col-sm-3">
                <input type="file" class="form-control" name="bukti_pembayaran">
            </div>
        </div>
        <input type="hidden" value="{{$pesanan->id}}" name="id">

        <button type="submit" class="btn bg-purple text-white"
            {{ $pesanan->status_pembayaran == 'Sudah Bayar' ? 'disabled' : ''}}>Bayar</button>
    </form>

    @if ($pesanan->status_pembayaran == 'Sudah Bayar')
    <a href="/dashboard-user"><button class="btn btn-danger mt-3">Kembali</button></a>
    @endif

</div>


@endsection
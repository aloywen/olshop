@extends('user.layout.app')
@section('title', 'Home Page')

@section('content')

@if (Session::has('log'))
<div class="row">
    <div class="col-sm-4">

        <div class="alert alert-danger" role="alert">
            {{Session::get('log')}}
        </div>
    </div>
</div>
@endif

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button> -->
    </div>
    <div class="carousel-inner">
        <!-- <div class="carousel-item active">
            <img src="/gambar/banner/a.jpg" width="w-full" height="400" class="d-block w-100">
        </div> -->
        <div class="carousel-item active">
            <img src="/gambar/banner/kk.jpg" width="w-full" height="400" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="/gambar/banner/4.jpeg" width="w-full" height="400" class="d-block w-100">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<h3 class="py-5 text-center">Produk</h3>


<div class="container">
    <div class="d-flex flex-wrap justify-content-center align-items">
        @foreach ($produk as $p)
        <div class="card m-3 h-100 shadow-sm" style="width: 15rem">

            <img src="/gambar/produk/{{$p->gambar}}" class="card-img-top" value="{{$p->nama_produk}}">
            {{-- <input type="hidden" value="{{$data->id}}" name="customer_id"> --}}
            <input type="hidden" value="{{$p->gambar}}" name="gambar">
            <input type="hidden" value="{{$p->nama_produk}}" name="nama_produk">
            <input type="hidden" value="{{$p->harga}}" name="harga">
            <div class="card-body">
                <h5 class="card-title">{{$p->nama_produk}}</h5>
                <p class="card-text">@currency($p->harga)</p>
            </div>
            <div class="card-footer">
                @if (\Session::has('user'))

                <a href="/detail-produk/{{$p->id}}">
                    <button type="button" class="btn bg-purple text-white rounded">Lihat Produk</button>
                </a>

                @else

                <a href="/log">
                    <button type="button" class="btn bg-purple text-white rounded">Lihat Produk</button>
                </a>

                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>


@endsection
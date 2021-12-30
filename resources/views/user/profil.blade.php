@extends('user.layout.app')
@section('title', 'Profil Perusahaan')

@section('content')


<h3 class="py-5 text-center">Tentang {{$data->nama_web}}</h3>


<div class="container">

    <div class="d-flex flex-column justify-content-center">
        <div class="d-flex justify-content-center">
            <img src="/gambar/banner/{{$data->logo}}" class="w-50 w-md-50" height="250">
        </div>
        <div>
            <p class="h5 p-5">{{$data->tentang}}</p>
            <p class="h5 p-5">{{$data->tentang2}}</p>
            <p class="h5 p-5">{{$data->tentang3}}</p>

        </div>
    </div>

</div>


@endsection
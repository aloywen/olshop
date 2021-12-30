@extends('user.layout.app')
@section('title', 'Keranjang')

@section('content')

<div class="container">
    <p class="h4 my-3">Keranjang</p>
    <p class="text-danger h5">{{$user->alamat == null ? 'Silahkan Isi Alamat Terlebih Dahulu!' : ''}}</p>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Paket</th>
                <th scope="">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @php $no=0 @endphp
            @foreach ($keranjang as $k)
            @php $no++ @endphp
            <tr>
                <th scope="row">{{$no}}</th>
                <td>{{$k->nama_produk}}</td>
                <td>
                    <input type="text" id="qty" class="form-control" onkeyup="total()" required>
                    @if ($errors->has('jumlah'))
                        <p class="text-danger">Tidak Boleh Kosong!</p>
                    @endif
                </td>
                <td><span class="harga" id="harga">@currency($k->harga)</span></td>
                <td>
                    <form action="/hapusKeranjang/{{$k->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger mt-3"
                            onclick="alert('yakin ingin menghapusnya?')">hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th scope="row">Total yang dibayar</th>
                <form action="/addPesanan" method="POST">
                    @csrf

                    <th scope="row"><input class="form-control" id="total" type="text" value="" name="total" readonly>
                    </th>
                    <th>
                        <input type="hidden" name="id" value="{{ $k->id ?? ''}}">
                        <input type="hidden" name="nama_produk" value="{{$k->nama_produk ?? ''}}">
                        <input type="hidden" name="customer_id" value="{{$user->id ?? ''}}">
                        <input type="hidden" name="pemesan" value="{{$user->name ?? ''}}">
                        <input type="hidden" id="jumlah" name="jumlah" value="" required>
                        <input type="hidden" name="no_hp" value="{{$user->no_hp ?? ''}}">
                        <input type="hidden" name="alamat" value="{{$user->alamat ?? ''}}">
                        <input type="hidden" name="status_pembayaran" value="Belum Bayar">
                        <input type="hidden" name="keterangan" value="Pending">
                        <input type="hidden" name="gambar" value="{{$k->gambar ?? ''}}">
                        <button type="submit" class="btn bg-purple text-white" 
                            {{$user->alamat == null ? 'disabled' : ''}}
                            {{$p == '0' ? 'disabled' : ''}}
                            >Pesan</button>
                </form>
                </th>
            </tr>
        </tfoot>
    </table>
</div>


@endsection

<script>
    function toRp(a,b,c,d,e){e=function(f){return f.split('').reverse().join('')};b=e(parseInt(a,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return'Rp.'+e(d)+''}

    
    function total(){
        let qty = document.getElementById("qty").value;
        console.log('qty',kurang);
        document.getElementById('jumlah').value = qty
    
        let harga = document.getElementById("harga").innerHTML.replace(/,.*|\D/g, "");
        console.log('harga',tambah);
        
       
        let total= parseInt(qty) * parseInt(harga);
        console.log(total);
        document.getElementById("total").value = toRp(total);
}


    function tambah(){

        plus = 1

        let jumlah = document.getElementById('jumlah').innerHTML;
        let total = plus++
        console.log('jumlah :',total);
    }
    function kurang(){

        plus = 1

        let jumlah = document.getElementById('jumlah').innerHTML;

        let total = plus--
        console.log('jumlah :',total);
    }

</script>
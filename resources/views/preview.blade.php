@extends('layouts.sidebar')
@section('content')
<div class="container">
  <h1>List Produk</h1>
  <div class="row">
      @foreach($details as $detail)
          <div class="col-md-4 mb-4">
              <div class="card">
                  <img src="{{asset('/gambar/').'/'  . $detail['gambar']}}" alt="image" height="300" width="355 " class="card-img-top" alt="{{$detail['nama_product']}}">
                  <div class="card-body">
                      <h5 class="card-title">{{$detail['nama_product']}}</h5>
                      <br>
                      <h5 class="card-title"> Size:{{$detail['size']}}</h5>
                      <br>
                      <h5 class="card-title"> Rp.{{ number_format($detail['harga'], 0, ',', '.') }}</h5>
                      <!-- tambahkan tombol atau link untuk detail produk jika diperlukan -->
                  </div>
              </div>
          </div>
      @endforeach
  </div>
</div>


@endsection

@extends('layouts.sidebar')
@section('content')
<div class="container py-0">
    <div class="row" flex-direction="row">
      @foreach ($orderList as $order_id => $item)
      <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
        <div class="card">
          <div class="d-flex justify-content-between p-3">
            <p class="lead mb-0">Daftar Pesasan</p>
            <h6 class="lead mb-0">To:{{$item->name_customer}}</h6>
          </div>
          <img src="{{asset('/gambar/').'/'  . $item['gambar']}}" alt="image" height="300" width="355 "
            class="card-img-top" alt=""  />
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <p class="small"><a href="{{ url('bayars/'). '/'  .$item->order_id}}" class="text-muted">Cestak Struk</a></p>
              <h6 class="mb-0">{{$item->tanggal_pemesanan}}</h6>
            </div>

            <div class="d-flex justify-content-between mb-3">
              <h5 class="mb-0">{{$item->nama_product}}</h5>
              <h5 class="text-dark mb-0">{{$item->harga}}</h5>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-0">Size : {{$item->size}}</h5>
                <h5 class="text-dark mb-0">Order ID :{{$item->order_id}}</h5>
              </div>
            {{-- {{-- <p class="btn-holder"><a href="{{ route('add.to.cart', $item->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p> --}}
            <p class="btn-holder"><a href="{{ route('pesananlunas', $item->order_id) }}" class="btn btn-info btn-block text-center" role="button">Lunas</a> </p> 
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div> 
@endsection
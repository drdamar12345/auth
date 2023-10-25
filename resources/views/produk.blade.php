@extends('layouts.sidebar')

@section('content')
<div class="container py-2">
    <div class="row" flex-direction="row">
      @foreach ($product as $item)
      <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
        <div class="card">
          <div class="d-flex justify-content-between p-3">
            <p class="lead mb-0">Daftar Sepetu</p>
          </div>
          <img src="{{asset('')  . $item->gambar}}" alt="image" height="300" width="355 "
            class="card-img-top" alt=""  />
          <div class="card-body">
            {{-- <div class="d-flex justify-content-between">
              <p class="small"><a href="{{ url('products/'). '/'  .$item->id}}" class="text-muted">FOOD</a></p>
            </div> --}}

            <div class="d-flex justify-content-between mb-3">
              <h5 class="mb-0">{{$item->nama_product}}</h5>
              <h5 class="text-dark mb-0">{{$item->harga}}</h5>
            </div>
            {{-- <p class="btn-holder"><a href="{{ route('add.to.cart', $item->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
            <p class="btn-holder"><a href="{{ route('add.to.favourite', $item->id) }}" class="btn btn-info btn-block text-center" role="button">Add to favourite</a> </p> --}}


            <div class="d-flex justify-content-between mb-2">
              <div class="ms-auto text-warning">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div> 
@endsection
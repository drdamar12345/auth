@extends('layouts.sidebar')
@section('content')
<div class="container ">
  <div class="row" flex-direction="row">
      @foreach ($details as $item)
        {{ csrf_field() }}
        <div class="container py-3">
          <div class="row" >
            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
              <div class="card">
                <div class="d-flex justify-content-between ">
                  <p class="lead mb-0">Daftar Detail Product</p>
                </div>
                <img src="{{asset('/gambar/').'/'  . $item['gambar']}}" alt="image" height="300" width="355 "
                  class="card-img-top" alt=""  />
                <div class="card-body">
                  {{-- <div class="d-flex justify-content-between">
                    <p class="small"><a href="{{ url('products/'). '/'  .$item->id}}" class="text-muted">FOOD</a></p>
                  </div> --}}      
                  <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">{{$item['nama_product']}}</h5>
      
                    {{-- <input type="hidden" class="text-dark mb-0" name="harga" value="{{$item['harga']}}">Rp.<span id="priceDisplay"></span></h5> --}}
                  </div>
                  {{-- <p class="btn-holder"><a href="{{ route('add.to.cart', $item->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to Keranjang</a> </p> --}}
                  {{-- <p class="btn-holder"><a href="{{ route('add.to.favourite', $item->id) }}" class="btn btn-info btn-block text-center" role="button">Add to favourite</a> </p> --}}
      
      
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
          </div>
        </div> 
      @endforeach
  </div>
</div>

@endsection

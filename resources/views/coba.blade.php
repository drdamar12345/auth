@extends('layouts.sidebar')
@section('content')
<div class="container">
    <h1>Produk yang Sering Dipesan</h1>
    
    @foreach($products as $product)
      <div class="product">
        <h2>{{ $product->nama_product }}</h2>
        <p>{{ $product->product_description }}</p>
        <p>Total Dipesan: {{ $product->total_orders }}</p>
        <button>Beli Sekarang</button>
      </div>
    @endforeach

  </div>
@endsection
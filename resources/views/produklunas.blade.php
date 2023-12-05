@extends('layouts.sidebar')
@section('content')
<div class="wrapper">
  <!-- Main content -->
  <section class="produk lunas">
    <div class="row">
      <div class="col-12 table-responsive">
        <style>
          table {
              border-collapse: collapse;
              width: 100%;
          }
      
          th, td {
              border: 1px solid black; /* Mengatur garis untuk sel dan header */
              padding: 8px; /* Padding untuk sel */
              text-align: left; /* Penataan teks di dalam sel */
          }
      </style>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Order_id</th>
            <th>Name_Customer</th>
            <th>Total_Produk</th>
            <th>Total</th>
            <th>Tanggal_Pemesanan</th>
          </tr>
          </thead>
          <tbody>
            @php $i=1 @endphp
            @foreach ($products as $product)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{$product->order_id}}</td>
              <td>{{$product->name_customer}}</td>
              <td>{{$product->qty}}</td>
              <td>Rp.{{ number_format($product->harga, 0, ',', '.') }}</td>
              <td>{{$product->tanggal_pemesanan}}</td>
              <td class="actions" data-th="">
                <p class="small"><a href="{{ url('previews/'). '/'  .$product->order_id}}" class="text-muted">Detail</a></p>
              </td>
            </tr>
            {{-- <p class="small"><a href="{{ url('bayars/'). '/'  .$item->order_id}}" class="text-muted">Cestak Struk</a></p> --}}
            {{-- <p class="btn-holder"><a href="{{ route('pesananlunas', $item->order_id) }}" class="btn btn-info btn-block text-center" role="button">Lunas</a> </p>  --}}
            
                
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@endsection

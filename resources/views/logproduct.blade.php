@extends('layouts.sidebar')

@section('content')
<h6 class="float_right">
    <form action="{{ route('generatelogproduct') }}" method="post">
      @csrf
      <label for="start_date">Tanggal Awal:</label>
      <input type="date" name="start_date" required>

      <label for="end_date">Tanggal Akhir:</label>
      <input type="date" name="end_date" required>

      <button class="btn btn-success text-center" type="submit">Cari</button>
    </form>
</h6>
<table id="cart" class="table table-hover table-condensed">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
    
        th, td {
            border: 3px solid green; /* Mengatur garis untuk sel dan header */
            padding: 8px; /* Padding untuk sel */
            text-align: left; /* Penataan teks di dalam sel */
        }
    </style>

    <thead>

        <tr>

            <th style="width:15%">Nama Product</th>

            <th style="width:5%">Size</th>

            <th style="width:15%">Nominal</th>

            <th style="width:5%" >Qty</th>

            <th style="width:15%" >Nama Admin</th>

            <th style="width:15%" >Tanggal</th>            

            <th style="width:10%">Deskripsi</th>

            <th style="width:20%">Subtotal</th>


        </tr>

    </thead>
    <tbody>
        @foreach ($products  as $product)
        <tr data-id="{{$product->id}}">
            <td>{{$product->name_product}}</td>
            <td>{{$product->size}}</td>
            <td>Rp.{{ number_format($product->price, 2, ',', '.') }}</td>
            <td>{{$product->qty}}</td>
            <td>{{$product->name_admin}}</td>
            <td>{{$product->date}}</td>
            <td>{{$product->note}}</td>
            <td>Rp.{{ number_format($product->total, 2, ',', '.') }}</td>
        <tr>
        @endforeach
    </tbody>
</table>
@endsection
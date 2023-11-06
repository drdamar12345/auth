@extends('layouts.sidebar')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Restock Barang</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('restockaction')}}" method="POST">
        {{ csrf_field() }}
      <div class="card-body">
        <div class="form-select">
            <label><i class=""></i> Name Product</label>
            <select class="selectpicker" name="nama">
                @foreach ($product as $item)
                <option type="radio" value="{{$item->id}}" title="">{{$item->nama_product}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
            <input name="tanggal_pemesanan" type="date" class="form-control"  placeholder="tanggal pemesanan">
          </div>
        <div class="form-select">
          <label><i ></i> Size</label>
          <select class="selectpicker" name="size">
            <option type="radio" value="37" title="37">37</option>
            <option type="radio" value="38" title="38">38</option>
            <option type="radio" value="39" title="39">39</option>
            <option type="radio" value="40" title="40">40</option>
            <option type="radio" value="41" title="41">41</option>
            <option type="radio" value="42" title="42">42</option>
            <option type="radio" value="43" title="43">43</option>
            <option type="radio" value="44" title="44">44</option>
          </select>              
      </div>
      <div class="form-group">
        <label for="qty">Quantity</label>
        <input name="qty" type="number" class="form-control"  placeholder="jumlah produk">
      </div>
      

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
@endsection;
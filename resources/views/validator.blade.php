@extends('layouts.sidebar')

@section('content')
<table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>

            <th style="width:25%">Name Product</th>

            <th style="width:25%">Total Product</th>

            <th style="width:25%">Tanggal Pesanan</th>

            <th style="width:25%">Harga Pesanan</th>


            <th style="width:10%"></th>

        </tr>

    </thead>
    <tbody>
        @foreach ($pesanan  as $item)
        <tr data-id="{{$item->id}}">
            <input type="hidden" name="id" value="{{$item->id}}">
            <td>{{$item->nama_product}}</td>
            <td>{{$item->qty}}</td>
            <td>{{$item->tanggal_pemesanan}}</td>
            <td>Rp.{{$item->harga}}</td>
            <td class="actions" data-th="">
                <a  href="{{ route('validatoraccept', $item->id) }}"> <button class="btn btn-success">accept</button> </a>                        
            </td>
            <td class="actions" data-th="">
                <a  href=""> <button class="btn btn-danger">cancel</button> </a>                        
            </td>
        <tr>
        @endforeach
    </tbody>
</table>
@endsection;
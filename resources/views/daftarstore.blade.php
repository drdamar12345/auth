@extends('layouts.admin')
@section('content')
<table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>

            <th style="width:20%">Name Store</th>

            <th style="width:25%">Address</th>

            <th style="width:25%">Name Owner</th>

            <th style="width:20%" >Product Store</th>

            <th style="width:20%" >ID Store</th>

            <th style="width:10%"></th>

        </tr>

    </thead>
    <tbody>
        @foreach ($stores  as $store)
        <tr>
            <td>{{$store->name_store}}</td>
            <td>{{$store->address}}</td>
            <td>{{$store->name_owner}}</td>
            <td>{{$store->product_store}}</td>
            <td>{{$store->id}}</td>
        <tr>
        @endforeach
    </tbody>
</table>
@endsection
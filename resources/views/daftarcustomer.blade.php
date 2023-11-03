@extends('layouts.sidebar')
@section('content')
<table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>

            <th style="width:20%">Name Customer</th>

            <th style="width:10%">Age</th>

            <th style="width:15%">Gender</th>

            <th style="width:20%" >Address</th>

            <th style="width:20%" >Date</th>

            <th style="width:15%" >Status</th>

            <th style="width:10%"></th>

        </tr>

    </thead>
    <tbody>
        @foreach ($stores  as $store)
        <tr data-id="{{$store->id}}">
            <input type="hidden" name="id" value="{{$store->id}}">
            <td>{{$store->nama}}</td>
            <td>{{$store->umur}}</td>
            <td>{{$store->gender}}</td>
            <td>{{$store->alamat}}</td>
            <td>{{$store->tanggal_lahir}}</td>
            <td>{{$store->status}}</td>
            <td>    
                <div class="d-flex justify-content-between">
                    <p class="small"><a href="{{ url('details/'). '/'  .$store->id}}" class="text-muted">EDIT</a></p>
                </div>                 
            </td>
        <tr>
        @endforeach
    </tbody>
</table>
@endsection
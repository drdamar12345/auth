@extends('layouts.admin')
@section('content')
<form >
    <table id="cart" class="table table-hover table-condensed">

        <thead>
    
            <tr>
    
                <th style="width:20%">Name Admin</th>
    
                <th style="width:25%">Email Admin</th>
    
                <th style="width:25%">ID Store</th>
    
                <th style="width:10%"></th>
    
            </tr>
    
        </thead>
        <tbody>
            @foreach ($admins  as $admin)
            <tr data-id="{{$admin->id}}">
                <input type="hidden" name="id" value="{{$admin->id}}">
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->store_id}}</td>
                <td>    
                    <div class="d-flex justify-content-between">
                        <p class="small"><a href="{{ url('stores/'). '/'  .$admin->id}}" class="text-muted">EDIT</a></p>
                    </div>                 
                </td>
            <tr>
            @endforeach
        </tbody>
    </table>
</form>
@endsection
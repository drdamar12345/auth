@extends('layouts.sidebar')
@section('content')
<div class="wrapper">
    <!-- Main content -->
    <section class="customer">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <!-- /.row -->
  
      <!-- Table row -->
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
                <th >No</th> 
                
                <th >Name Customer</th>

                <th >Age</th>
    
                <th >Gender</th>
    
                <th  >Address</th>
    
                <th  >Date</th>
    
            </tr>
            </thead>
            <tbody>
              @php $i=1 @endphp
              @foreach ($stores  as $store)
                <tr data-id="{{$store->id}}">
                    <td>{{ $i++ }}</td>
                    <td>{{$store->nama}}</td>
                    <td>{{$store->umur}}</td>
                    <td>{{$store->gender}}</td>
                    <td>{{$store->alamat}}</td>
                    <td>{{$store->tanggal_lahir}}</td>
                <tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
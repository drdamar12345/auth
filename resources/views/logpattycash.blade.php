@extends('layouts.sidebar')

@section('content')
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <div>
              <h6 class="float_right">
                <form action="" method="post">
                  @csrf
                  <label for="start_date">Tanggal Awal:</label>
                  <input type="date" name="start_date" required>

                  <label for="end_date">Tanggal Akhir:</label>
                  <input type="date" name="end_date" required>

                  <button class="btn btn-success text-center" type="submit">Generate Laporan</button>
                </form>
              </h6>
            </div>    
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
              <th>No</th>
              <th>Name_Admin</th>
              <th>Nominal</th>
              <th>Date</th>
            </tr>
            </thead>
            <tbody>
              @php $i=1 @endphp
              @foreach ($historys as $history)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{$history->name_admin}}</td>
                <td>{{ number_format($history->nominal, 0, ',', '.') }}</td>
                <td>{{$history->date}}</td>
              </tr>
              
                  
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
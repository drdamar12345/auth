@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Customer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('addnewcustomer')}}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Name Customer</label>
                    <input name="nama" type="text" class="form-control"  placeholder="name customer">
                  </div>
                  <div class="form-group">
                    <label for="umur">Age</label>
                    <input name="umur" type="text" class="form-control"  placeholder="Age">
                  </div>
                  <div class="form-group">
                    <label><i class="fa fa-venus-mars"></i> Gender</label>
                    <input type="radio" name="gender" value="Laki Laki" class="" placeholder="Jenis Kelamin" required="">Laki Laki
                    <input type="radio" name="gender" value="Perempuan" class="" placeholder="Jenis Kelamin" required="">Perempuan
                </div>
                  <div class="form-group">
                    <label for="alamat">Address</label>
                    <input name="alamat" type="text" class="form-control"  placeholder="alamat">
                  </div>
                  <div class="form-group">
                    <label for="tanggal_lahir">Date of Birth</label>
                    <input name="tanggal_lahir" type="date" class="form-control"  placeholder="tanggal lahir">
                  </div>
                  {{-- <div class="form-select">
                    <label><i class="fa fa-venus-mars"></i> Status</label>
                    <select class="selectpicker" name="status">
                      <option type="radio" value="silver" title="silver">silver</option>
                      <option type="radio" value="platinum" title="platinum">platinum</option>
                      <option type="radio" value="gold" title="gold">gold</option>
                    </select>              
                </div> --}}
                  
                  
                      
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
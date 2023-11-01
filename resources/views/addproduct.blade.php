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
                <h3 class="card-title">Add Product Baru</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('addnewproduct')}}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_product">Name Product</label>
                    <input name="nama_product" type="text" class="form-control"  placeholder="name product">
                  </div>
                  <div class="form-group">
                    <label for="merk">Merk</label>
                    <input name="merk" type="text" class="form-control"  placeholder="merk product">
                  </div>
                  <div class="form-group">
                    <label for="warna">Color Product</label>
                    <input name="warna" type="text" class="form-control"  placeholder="warna product">
                  </div>
                  <div class="form-group">
                    <label for="stok">Quantity</label>
                    <input name="stok" type="number" class="form-control"  placeholder="stok product">
                  </div>
                  {{-- <div class="form-group">
                    <label for="exampleSelectRounded0">Flat <code>.rounded-0</code></label>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0">
                      <option>Value 1</option>
                      <option>Value 2</option>
                      <option>Value 3</option>
                    </select>
                  </div> --}}
                  <div class="form-group">
                    <label for="harga">Price</label>
                    <input  name="harga" type="text" class="form-control"  placeholder="harga product">
                  </div>
                  <div class="form-group">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Gambar</label>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="gambar" required>
                    </div>
                </div>
                  <div class="form-group">
                    <label><i class="fa fa-venus-mars"></i> Ukuran</label>
                    <div class="row" >
                      <br>
                      <input class="form-input" type="checkbox" id="37" name="size[]" value="37" >
                      <label class="form-check-label">37</label>
                      <br>
                      <input class="form-input" type="checkbox" id="38" name="size[]" value="38" >
                      <label class="form-check-label">38</label>
                      <br>
                      <input class="form-input" type="checkbox" id="39" name="size[]" value="39" >
                      <label class="form-check-label">39</label>
                      <br>
                      <input class="form-input" type="checkbox" id="40" name="size[]" value="40" >
                      <label class="form-check-label">40</label>
                      <br>
                      <input class="form-input" type="checkbox" id="41" name="size[]" value="41" >
                      <label class="form-check-label">41</label>
                      <br>
                      <input class="form-input" type="checkbox" id="42" name="size[]" value="42" >
                      <label class="form-check-label">42</label>
                      <br>
                      <input class="form-input" type="checkbox" id="43" name="size[]" value="43" >
                      <label class="form-check-label">43</label>
                      <br>
                      <input class="form-input" type="checkbox" id="44" name="size[]" value="44" >
                      <label class="form-check-label">44</label>
                    </div>
                  </div>
                  
                  
                      
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

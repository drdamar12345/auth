@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @foreach ($cash as $item)
              <div class="card-header">Patty Cash : Rp.{{ number_format($item->patty_cash, 0, ',', '.') }}</div>
              @endforeach

            
                <form action="{{route('addpettycash')}}" method="POST">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="patty_cash">Cash Today</label>
                      <input name="patty_cash" type="number" class="form-control"  placeholder="cash hari ini">
                    </div>
                  </div>
                  <input type="hidden" name="store_id" value="{{ Auth::user()->store_id }}">
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div>
  <h2 class="text-center">PRODUK SERING CHECKOUT</h3>
  <table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>
            <th>No</th>

            <th style="width:70%">Produk</th>

            <th style="width:15%">Merk</th>
    
            <th style="width:15%" >Total Terjual</th>

            <th style="width:10%"></th>

        </tr>

      </thead>
      <tbody>
        @php $total = 1 @endphp

        {{-- @if(session('keranjang')) --}}

            {{-- @foreach(session('cart') as $id => $details) --}}
            @foreach($products as $product)

                <tr >

                  <td>{{ $total++ }}</td>


                    <td data-th="Product">

                        <div class="row">

                            <div class="col-sm-3 hidden-xs"><img src="{{asset('/gambar/').'/'  . $product->gambar}}" width="100" height="50" class="img-responsive"/></div>

                            <div class="col-sm-9">

                                <h4 class="nomargin">{{ $product->nama_product }}</h4>


                            </div>

                        </div>

                    </td>

                    <td data-th="Merk">{{ $product->merk }}</td>

                    <td data-th="Total Terjual">{{ $product->total_orders }}</td>


                    <td class="actions" data-th="">

                      {{-- <a  href="{{ route('addtobatal', $details->id) }}" class="btn btn-success"> BATAL </a>                         --}}
                    </td>

                </tr>

            @endforeach
        {{-- @endif --}}
      </tbody>
      <tfoot>
    </tfoot>
  </table>
</div>
<div>
  <h2 class="text-center">STOK PRODUCT HAMPIR HABIS</h3>
  <table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>
            <th>No</th>

            <th style="width:70%">Produk</th>

            <th style="width:15%">Size</th>
    
            <th style="width:15%" >Stock</th>

            <th style="width:15%" >Harga</th>

            <th style="width:10%"></th>

        </tr>

      </thead>
      <tbody>
        @php $total = 1 @endphp

        {{-- @if(session('keranjang')) --}}

            {{-- @foreach(session('cart') as $id => $details) --}}
            @foreach($stockminims as $stockminim)

                <tr >

                  <td>{{ $total++ }}</td>


                    <td data-th="Product">

                        <div class="row">

                            <div class="col-sm-3 hidden-xs"><img src="{{asset('/gambar/').'/'  . $stockminim->gambar}}" width="100" height="50" class="img-responsive"/></div>

                            <div class="col-sm-9">

                                <h4 class="nomargin">{{ $stockminim->nama_product }}</h4>


                            </div>

                        </div>

                    </td>

                    <td data-th="Merk">{{ $stockminim->size }}</td>

                    <td data-th="Total Terjual">{{ $stockminim->stok }}</td>

                    <td data-th="Total Terjual">Rp{{ number_format($stockminim->price, 0, ',', '.') }}</td>


                    <td class="actions" data-th="">

                      {{-- <a  href="{{ route('addtobatal', $details->id) }}" class="btn btn-success"> BATAL </a>                         --}}
                    </td>

                </tr>

            @endforeach
        {{-- @endif --}}
      </tbody>
      <tfoot>
    </tfoot>
  </table>
</div>
<div class="modal fade" id="lowStockModal" tabindex="-1" role="dialog" aria-labelledby="lowStockModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="lowStockModalLabel">Low Stock Alert</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- Isi pesan atau informasi di sini -->
              Terdapat Produk Stok Sedikit.
              <div>{{ $stockminim->nama_product }}</div>
              <div>Harga:Rp.{{ number_format($stockminim->price, 0, ',', '.') }}</div>
              <div>Size:{{ $stockminim->size }}</div>
              <div>Sisa Stok:{{ $stockminim->stok }}</div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
<script>
  // Lakukan periksa stok
  var stockminims = {!! json_encode($stockminims) !!}; // Ambil data barang dari controller
  var lowStock = false;

  // Loop melalui data barang
  stockminims.forEach(function(stockminim) {
      if (stockminim.stok < 3) {
          lowStock = true;
      }
  });

  // Jika ada barang dengan stok kurang dari 3, tampilkan modal
  if (lowStock) {
      $(document).ready(function(){
          $('#lowStockModal').modal('show');
      });
  }
</script>
@endsection

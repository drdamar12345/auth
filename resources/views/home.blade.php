@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              {{-- @foreach ($cash as $item)
              <div class="card-header">Patty Cash : Rp.{{ number_format($item->patty_cash, 0, ',', '.') }}</div>
              @endforeach --}}
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
  PRODUK FAVORIT  
  <table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>

            <th style="width:70%">Produk</th>

            <th style="width:15%">Merk</th>
    
            <th style="width:15%" >Total Terjual</th>

            <th style="width:10%"></th>

        </tr>

      </thead>
      <tbody>
        @php $total = 0 @endphp

        {{-- @if(session('keranjang')) --}}

            {{-- @foreach(session('cart') as $id => $details) --}}
            @foreach($products as $product)

                <tr >

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
@endsection

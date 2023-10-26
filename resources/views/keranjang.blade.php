@extends('layouts.sidebar')

@section('content')
<form  >
    @csrf
    <table id="cart" class="table table-hover table-condensed">

      <thead>
  
          <tr>
  
              <th style="width:70%">Produk</th>
  
              <th style="width:15%">Harga</th>
      
              <th style="width:15%" >Batal</th>
  
              <th style="width:10%"></th>
  
          </tr>
  
        </thead>
        <tbody>
          @php $total = 0 @endphp

          @if(session('keranjang'))
  
              {{-- @foreach(session('cart') as $id => $details) --}}
              @foreach($cart as $id => $details)
  
                  @php $total += intval($details->harga) * intval($details->qty) @endphp
  
                  <tr data-id="{{ $id }}">
  
                      <td data-th="Product">
  
                          <div class="row">
  
                              <div class="col-sm-3 hidden-xs"><img src="{{ $details->gambar }}" width="100" height="50" class="img-responsive"/></div>
  
                              <div class="col-sm-9">
  
                                  <h4 class="nomargin">{{ $details->nama_product }}</h4>

                                  <input type="hidden" name="product_id[]" value="{{$details->id_product}}">

                              </div>
  
                          </div>
  
                      </td>
  
                      <td data-th="Price">Rp{{ $details->harga }}</td>
  
                        <input data-th="Subtotal" name="price[]" type="hidden" class="text-center" value="{{ intval($details->harga) * intval($details->qty) }}">{{ intval($details->harga) * intval($details->qty) }}</td>
  
                      <td class="actions" data-th="">
                        
                          <button class="btn btn-danger btn-sm remove-from-cart"row-id='{{$details->id}}'>BATAL</button>
                        
                      </td>
                      <td class="actions" data-th="">

                        {{-- <a  href="{{ route('addtobatal', $details->id) }}" class="btn btn-success"> BATAL </a>                         --}}
                      </td>
  
                  </tr>
  
              @endforeach
          @endif
        </tbody>
        <tfoot>

          <tr>
            <input type="hidden" name="subtotal" value="{{$total}}">
              <td colspan="5" class="text-right"><h3><strong>Total Rp{{ $total }}</strong></h3></td>
  
          </tr>
  
          <tr>
  
              <td colspan="5" class="text-right">
  
                  {{-- <a href="{{ url('/food/0') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a> --}}
                  
                  {{-- @if (isset($details))
                  <a  href="{{ route('addtocheckout', $details->id) }}"> <button class="btn btn-success">Checkout</button> </a>
                  @endif
                   --}}
                   <button type="submit" button class="btn btn-success" >Checkout</button>
  
              </td>
  
          </tr>
      </tfoot>
      </table>
  </form>
@endsection
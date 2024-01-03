@extends('layouts.app')
@section('nav-transaction', 'active border-bottom border-3')
@section('content')
   <div class="container mt-3">
      <h1 class="mb-4">Transaction</h1>
      <div class="row">
         <div class="col-md-7">
            <div class="card table-responsive shadow-sm rounded-4">
               <div class="card-header bg-transparent py-3">
                  <h3 class="mb-0">Data Item</h3>
               </div>
               <div class="card-body">
                  <table class="m-0 table table-hover table-bordered">
                     <thead>
                        <tr>
                           <th style="width: 9px;">#</th>
                           <th>Nama</th>
                           <th>Category</th>
                           <th>Harga</th>
                           <th>Stock</th>
                           <th style="width: 9px;white-space: nowrap">Tambah</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($items as $ix => $i)
                           <tr>
                              <td>{{ $ix + 1 }}</td>
                              <td>{{ $i->name }}</td>
                              <td>{{ $i->category->name }}</td>
                              <td>Rp. {{ number_format($i->price) }}</td>
                              <td>{{ $i->stock }}</td>
                              <td style="width: 9px;white-space: nowrap; text-align: center">
                                 <a href="{{ route('transaction.addToCart', $i) }}" class="btn btn-success">
                                    <i class="bi bi-plus"></i>
                                 </a>
                              </td>
                           <tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-md-5">
            <div class="card">
               <div class="card-header bg-transparent py-3 mb-1">
                  <h3 class="mb-0">Keranjang Anda</h3>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Item</th>
                              <th>Qty</th>
                              <th>Subtotal</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if (session('cart'))
                              <form id="form-action" method="POST" action="">
                                 @foreach (session('cart') as $ix => $item)
                                    @csrf
                                    <tr>
                                       <td>{{ $ix + 1 }}</td>
                                       <td>{{ $item['name'] }}</td>
                                       <td>
                                          <input type="number" class="form-control input-qty" name="qty-{{ $item['id'] }}"
                                             onchange="handleEdit({{ $item['id'] }}, {{ $item['price'] }})"
                                             id="qty-{{ $item['id'] }}" value="{{ $item['qty'] }}" min="0">
                                       </td>
                                       <td>Rp. <span
                                             id="subtotal-{{ $item['id'] }}">{{ number_format($item['subtotal']) }}</span>
                                       </td>
                                       <td style="width: 0px; white-space: nowrap">
                                          <button class="btn btn-warning d-none  " id="btn-update-{{ $item['id'] }}"
                                             type="submit"
                                             onclick="setFormAction('{{ route('transaction.updateCart', $item['id']) }}', {{ $item['id'] }})">
                                             <i class="bi bi-pen"></i>
                                          </button>
                                          <button class="btn btn-danger" id="btn-delete-{{ $item['id'] }}"
                                             onclick="setFormAction('{{ route('transaction.delete', $item['id']) }}')">
                                             <i class="bi bi-trash"></i>
                                          </button>
                                       </td>
                                    </tr>
                                 @endforeach
                              </form>
                           @else
                              <tr>
                                 <td colspan="9" class="text-center">Tidak Ada data di Keranjang anda🛒</td>
                              </tr>
                           @endif
                        </tbody>
                     </table>
                     <div class="mb-4">
                        <div class="row mb-1">
                           <div class="col-md-4">
                              <label for="grand" class="form-label">Grand total</label>
                           </div>
                           <div class="col-md-8 d-flex align-items-center gap-2">
                              <span>:</span>
                              <input type="text" class="form-control" value="{{ $grandtotal }}">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <label for="grand" class="form-label">Payment</label>
                           </div>
                           <div class="col-md-8 d-flex align-items-center gap-2">
                              <span>:</span>
                              <input type="text" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="d-flex gap-2 justify-content-end">
                     <button class="btn btn-outline-danger w-100">Reset</button>
                     <button class="btn btn-primary w-100">Tambah</button>
                  </div>
               </div>
            </div>

         </div>

      </div>
   </div>
@endsection
@push('scripts')
   <script>
      function setFormAction(url, item_id) {
         $('#form-action').attr('action', url);
      }

      function handleEdit(item_id, item_price) {
         if ($('#qty-' + item_id).val() == 0) {
            $('#btn-update-' + item_id).addClass('d-none');
            $('#btn-delete-' + item_id).removeClass('d-none');
         } else {
            $('#btn-update-' + item_id).removeClass('d-none');
            $('#btn-delete-' + item_id).addClass('d-none');
            $('#subtotal-' + item_id).text(item_price * $('#qty-' + item_id).val());
         }
      }
   </script>
@endpush

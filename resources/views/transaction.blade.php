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
        <form action="" class="card shadow-sm rounded-4">
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
                    <th>Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  @if (session('cart'))
                    @foreach (session('cart') as $ix => $item)
                      <tr>
                        <td>{{ $ix + 1 }}</td>
                        <td>Jeruk</td>
                        <td>3</td>
                        <td>Rp. 20.000</td>
                        <td style="width: 0px; white-space: nowrap">
                          <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                    @endforeach
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
                    <input type="text" class="form-control">
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
        </form>
      </div>

    </div>
  @endsection

@extends('layouts.app')
@section('nav-item', 'active border-bottom border-3')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
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
                  <th>Harga</th>
                  <th>Stock</th>
                  <th style="width: 9px;white-space: nowrap">Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Lontong</td>
                  <td>Rp. 10.000</td>
                  <td>29</td>
                  <td style="width: 9px;white-space: nowrap">
                    <button class="btn btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                  </td>
                  <td style="width: 9px;white-space: nowrap">
                    <button class="btn btn-danger">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <form action="" class="card shadow-sm rounded-4">
          <div class="card-header bg-transparent py-3 mb-1">
            <h3 class="mb-0">Tambah Item</h3>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="name">Nama</label>
              <input type="text" class="form-control">
            </div>
            <div class="mb-3">
              <label for="price">Harga</label>
              <input type="number" class="form-control" name="price">
            </div>
            <div class="mb-5">
              <label for="stock">Stok</label>
              <input type="number" class="form-control" name="stock">
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <button class="btn btn-outline-danger w-100">Reset</button>
              <button class="btn btn-primary w-100">Tambah</button>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
@endsection

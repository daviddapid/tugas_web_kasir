@extends('layouts.app')
@section('nav-category', 'active border-bottom border-3')
@section('content')
  <div class="container mt-5">
    <div class="row">
      @if (session('success'))
        <div class="col-md-12">
          <div class="alert alert-success">
            <h3 class="mb-0">{{ session('success') }}</h3>
          </div>
        </div>
      @endif
      <div class="col-md-8">
        <div class="card table-responsive shadow-sm rounded-4">
          <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data category</h3>
            <button class="btn btn-primary" onclick="handleCreate()"><i class="bi bi-plus"></i></button>
          </div>
          <div class="card-body">
            <table class="m-0 table table-hover table-bordered">
              <thead>
                <tr>
                  <th style="width: 9px;">#</th>
                  <th>Nama</th>
                  <th style="width: 9px;white-space: nowrap">Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $i => $c)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $c->name }}</td>
                    <td style="width: 9px;white-space: nowrap">
                      <button class="btn btn-warning"
                        onclick="handleEdit({{ $c->id }}, '{{ route('category.update', $c->id) }}')">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                    </td>
                    <td style="width: 9px;white-space: nowrap">
                      <button class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <form action="{{ route('category.store') }}" id="form-category" method="POST" class="card shadow-sm rounded-4">
          @csrf
          <input type="hidden" name="_method" id="form-method">
          <div class="card-header bg-transparent py-3 mb-1">
            <h3 class="mb-0" id="form-header">Tambah Kategori</h3>
          </div>
          <div class="card-body">
            <div class="mb-5">
              <label for="name">Nama</label>
              <input type="text" id="category-name" class="form-control" name="name">
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <button class="btn btn-outline-danger w-100">Reset</button>
              <button class="btn btn-primary w-100" type="submit">Tambah</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    function handleCreate() {
      $("#form-header").text("Tambah Kategori");
    }

    function handleEdit(category_id, url) {
      $("#form-header").text("Edit Kategori");

      $('#form-method').val('PUT');
      $('#form-category').attr('action', url);

      $.get(`/category/${category_id}/edit`, (data) => {
        $('#category-name').val(data.name);
      });
    }
  </script>
@endpush

@extends('layouts.app')
@section('nav-item', 'active border-bottom border-3')
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
            <h3 class="mb-0">Data Item</h3>
            <button class="btn btn-primary" onclick="handleCreate('{{ route('item.store') }}')"><i
                class="bi bi-plus"></i></button>
          </div>
          <div class="card-body">
            <table class="m-0 table table-hover table-bordered">
              <thead>
                <tr>
                  <th style="width: 9px;">#</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Stock</th>
                  <th>Category</th>
                  <th style="width: 9px;white-space: nowrap">Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $i => $item)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>Rp. {{ number_format($item->price) }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td style="width: 9px;white-space: nowrap">
                      <button class="btn btn-warning"
                        onclick="handleEdit('{{ route('item.edit', $item) }}','{{ route('item.update', $item) }}')">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                    </td>
                    <td style="width: 9px;white-space: nowrap">
                      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete"
                        onclick="handleDelete('{{ route('item.destroy', $item) }}', {{ $item }})">
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
        <form action="{{ route('item.store') }}" class="card shadow-sm rounded-4" method="POST" id="form-item">
          @csrf
          <input type="hidden" name="_method" id="form-method">
          <div class="card-header bg-transparent py-3 mb-1">
            <h3 class="mb-0" id="form-title">Tambah Item</h3>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="name" class="@error('name') text-danger @enderror">Nama</label>
              <input type="text" class="form-control @error('name') is-invalid text-danger @enderror" name="name"
                id="input-name" value="{{ old('name') }}">
              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="price" class="@error('price') text-danger @enderror">Harga</label>
              <input type="number" class="form-control @error('price') is-invalid text-danger @enderror" name="price"
                id="input-price" value="{{ old('price') }}">
              @error('price')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="stock" class="@error('stock') text-danger @enderror">Stok</label>
              <input type="number" class="form-control @error('stock') is-invalid text-danger @enderror" name="stock"
                id="input-stock" value="{{ old('stock') }}">
              @error('stock')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-5">
              <label for="stock">Category</label>
              <select name="category_id" id="input-category" class="form-select" required
                value="{{ old('category_id') }}">
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($categories as $c)
                  <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>
                    {{ $c->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <button class="btn btn-outline-danger w-100" type="reset">Reset</button>
              <button class="btn btn-primary w-100" type="submit" id="btn-submit">Tambah</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal delete-->
  <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" id="form-delete">
            @csrf
            @method('delete')
            apa anda yakin untuk menghapus item: <span class="fw-bold" id="item-name-delete"></span>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" form="form-delete">Hapus</button>
        </div>
      </div>
    </div>
  </div>
  {{ $errors ?? null }}
@endsection
@push('scripts')
  <script>
    function handleCreate(url) {
      $('#form-item').trigger('reset');
      $('#form-method').val('POST');
      $('#form-title').text('Tambah Item');
      $('#form-item').attr('action', url);
      $('#btn-submit').text('Tambah');
    }

    function handleEdit(urlEdit, urlUpdate) {
      $.get(urlEdit, function(data, textStatus, jqXHR) {
        $('#input-name').val(data.name);
        $('#input-price').val(data.price);
        $('#input-stock').val(data.stock);
        $('#input-category').val(data.category_id);

        $('#form-method').val('PUT');
        $('#form-title').text('Edit Item');
        $('#form-item').attr('action', urlUpdate);
        $('#btn-submit').text('Update');
      });
    }

    function handleDelete(url, item) {
      $('#form-delete').attr('action', url);
      $('#item-name-delete').text(item.name);
    }
  </script>

  @if (session('error-store'))
    <script>
      handleCreate("{{ session('error-store')['url'] }}")
    </script>
  @elseif(session('error-update'))
    <script>
      handleEdit("{{ session('error-update')['urlEdit'] }}", "{{ session('error-update')['urlUpdate'] }}")
    </script>
  @endif
@endpush

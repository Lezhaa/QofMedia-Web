@extends('adminlte::page')

@section('title', 'Kelola Edisi Kaos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edisi Kaos</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus"></i> Tambah Edisi
        </button>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Nama Edisi</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($editions as $edition)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $edition->product->name ?? 'N/A' }}</td>
                            <td>{{ $edition->name }}</td>
                            <td>{{ $edition->year }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn" 
                                        data-id="{{ $edition->id }}"
                                        data-product="{{ $edition->product_id }}"
                                        data-name="{{ $edition->name }}"
                                        data-year="{{ $edition->year }}"
                                        data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('apparel.editions.destroy', $edition) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4">Belum ada edisi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <form action="{{ route('apparel.editions.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header"><h5>Tambah Edisi</h5></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Produk Kaos</label>
                            <select name="product_id" class="form-control" required>
                                <option value="">Pilih Produk</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Edisi</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-content">
                    <div class="modal-header"><h5>Edit Edisi</h5></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Produk Kaos</label>
                            <select name="product_id" id="editProduct" class="form-control" required>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Edisi</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="year" id="editYear" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        $('#editProduct').val($(this).data('product'));
        $('#editName').val($(this).data('name'));
        $('#editYear').val($(this).data('year'));
        $('#editForm').attr('action', '/apparel/editions/' + id);
    });
</script>
@stop
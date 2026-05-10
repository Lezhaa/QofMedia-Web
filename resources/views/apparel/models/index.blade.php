@extends('adminlte::page')

@section('title', 'Kelola Model/Motif')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Model/Motif Kaos</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus"></i> Tambah Model
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
                        <th>Nama Model</th>
                        <th>Edisi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($models as $model)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->edition->name ?? 'N/A' }}</td>
                            <td>
                                @if($model->design_image)
                                    <img src="{{ asset('storage/'.$model->design_image) }}" width="50">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn" 
                                        data-id="{{ $model->id }}"
                                        data-edition="{{ $model->edition_id }}"
                                        data-name="{{ $model->name }}"
                                        data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('apparel.models.destroy', $model) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4">Belum ada model</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <form action="{{ route('apparel.models.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header"><h5>Tambah Model</h5></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Edisi</label>
                            <select name="edition_id" class="form-control" required>
                                <option value="">Pilih Edisi</option>
                                @foreach($editions as $e)
                                    <option value="{{ $e->id }}">{{ $e->name }} ({{ $e->product->name ?? '' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Model</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Gambar Desain</label>
                            <input type="file" name="design_image" class="form-control">
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
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-content">
                    <div class="modal-header"><h5>Edit Model</h5></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Edisi</label>
                            <select name="edition_id" id="editEdition" class="form-control" required>
                                @foreach($editions as $e)
                                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Model</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Gambar Baru</label>
                            <input type="file" name="design_image" class="form-control">
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
        $('#editEdition').val($(this).data('edition'));
        $('#editName').val($(this).data('name'));
        $('#editForm').attr('action', '/apparel/models/' + id);
    });
</script>
@stop
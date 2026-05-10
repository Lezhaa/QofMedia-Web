@extends('adminlte::page')

@section('title', 'Tambah Item ke ' . $album->name)

@section('content_header')
    <div>
        <h1>Tambah Item ke Album: {{ $album->name }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">Album</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.albums.items.index', $album) }}">{{ $album->name }}</a></li>
            <li class="breadcrumb-item active">Tambah Item</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Foto/Video
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.albums.items.store', $album) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="type">Tipe Item <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="foto" {{ old('type') == 'foto' ? 'selected' : '' }}>📷 Foto</option>
                                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>🎬 Video</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="file">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" 
                                   class="form-control @error('file') is-invalid @enderror" 
                                   id="file" 
                                   name="file" 
                                   required 
                                   accept="image/*,video/*">
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Foto: JPG, PNG, GIF (maks 20MB) | Video: MP4, MOV, AVI (maks 20MB)
                            </small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="caption">Caption (Opsional)</label>
                            <input type="text" 
                                   class="form-control @error('caption') is-invalid @enderror" 
                                   id="caption" 
                                   name="caption" 
                                   value="{{ old('caption') }}" 
                                   placeholder="Deskripsi singkat foto/video">
                            <small class="form-text text-muted">Maksimal 255 karakter</small>
                            @error('caption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <hr>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Info:</strong> File akan disimpan di server.
                            <ul class="mb-0 mt-2">
                                <li>Foto dan Video maksimal 20MB</li>
                                <li>Format yang didukung: JPG, PNG, GIF, MP4, MOV, AVI</li>
                                <li>Maksimal 100 item per album</li>
                            </ul>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Item
                            </button>
                            <a href="{{ route('admin.albums.items.index', $album) }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Info Album
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if($album->cover_image)
                            <img src="{{ asset('storage/' . $album->cover_image) }}" 
                                 alt="{{ $album->name }}" 
                                 class="img-fluid rounded" 
                                 style="max-height: 150px;">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                 style="height: 150px; border-radius: 10px;">
                                <i class="fas fa-image text-white fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    
                    <table class="table table-sm">
                        <tr>
                            <th width="100">Nama</th>
                            <td>{{ $album->name }}</td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td>{{ $album->year }}</td>
                        </tr>
                        <tr>
                            <th>Total Item</th>
                            <td>
                                <span class="badge {{ $album->items->count() >= 100 ? 'badge-warning' : 'badge-info' }}">
                                    {{ $album->items->count() }} / 100 item
                                </span>
                            </td>
                        </tr>
                        @if($album->description)
                            <tr>
                                <th>Deskripsi</th>
                                <td><small>{{ $album->description }}</small></td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.albums.items.index', $album) }}" class="btn btn-outline-secondary btn-sm btn-block">
                        <i class="fas fa-images mr-1"></i> Lihat Semua Item
                    </a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Banyak Sekaligus
                    </h3>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Ingin upload banyak file sekaligus?</p>
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#uploadMultipleModal">
                        <i class="fas fa-upload mr-1"></i> Upload Banyak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Multiple Modal -->
    <div class="modal fade" id="uploadMultipleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.albums.items.upload-multiple', $album) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-upload mr-2"></i>
                            Upload Banyak File ke {{ $album->name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="modal_type">Tipe File <span class="text-danger">*</span></label>
                            <select name="type" id="modal_type" class="form-control" required>
                                <option value="foto">📷 Foto</option>
                                <option value="video">🎬 Video</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modal_files">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="files[]" multiple required accept="image/*,video/*">
                            <small class="form-text text-muted">
                                Anda dapat memilih banyak file sekaligus (maks 20MB per file).
                            </small>
                        </div>
                        @if($album->items->count() >= 100)
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Album sudah mencapai batas 100 item. Upload akan dibatasi.
                            </div>
                        @else
                            <div class="alert alert-info small">
                                <i class="fas fa-info-circle mr-1"></i>
                                File akan disimpan di server. Maksimal 100 item per album.
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" {{ $album->items->count() >= 100 ? 'disabled' : '' }}>
                            <i class="fas fa-upload mr-1"></i> Upload Semua
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
    </style>
@stop

@section('js')
    <script>
        // Preview file name when selected
        $('#file').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $(this).next('.form-text').html(
                    '<i class="fas fa-check-circle text-success mr-1"></i>' + 
                    'File dipilih: ' + fileName
                );
            }
        });
        
        // Show file count for multiple upload
        $('input[name="files[]"]').on('change', function() {
            var count = this.files.length;
            $(this).next('.form-text').html(
                '<i class="fas fa-check-circle text-success mr-1"></i>' + 
                count + ' file dipilih'
            );
        });
    </script>
@stop
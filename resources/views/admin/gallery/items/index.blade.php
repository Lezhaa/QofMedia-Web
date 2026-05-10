@extends('adminlte::page')

@section('title', 'Item Galeri: ' . $album->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Item Galeri: {{ $album->name }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">Album</a></li>
                <li class="breadcrumb-item active">{{ $album->name }}</li>
            </ol>
        </div>
        <div>
            <a href="{{ route('admin.albums.items.create', $album) }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Item
            </a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploadMultipleModal">
                <i class="fas fa-upload mr-1"></i> Upload Banyak
            </button>
            <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($items->count() > 0)
                <div class="row">
                    @foreach($items as $item)
                        <div class="col-md-3 col-sm-4 col-6 mb-3">
                            <div class="card h-100">
                                <div class="position-relative">
                                    @if($item->type == 'foto')
                                        <img src="{{ $item->file_url ?? asset('images/no-image.png') }}" 
                                             class="card-img-top" 
                                             alt="{{ $item->caption ?? 'Foto' }}"
                                             loading="lazy"
                                             style="height: 180px; object-fit: cover;"
                                             onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                                    @else
                                        <div class="bg-dark d-flex align-items-center justify-content-center" 
                                             style="height: 180px;">
                                            <i class="fas fa-video text-white fa-3x"></i>
                                        </div>
                                    @endif
                                    <span class="position-absolute top-0 end-0 m-2">
                                        <span class="badge badge-{{ $item->type == 'foto' ? 'info' : 'warning' }}">
                                            {{ $item->type == 'foto' ? 'Foto' : 'Video' }}
                                        </span>
                                    </span>
                                </div>
                                <div class="card-body p-2">
                                    @if($item->caption)
                                        <p class="small mb-2">{{ Str::limit($item->caption, 40) }}</p>
                                    @endif
                                    <p class="small text-muted mb-2">{{ $item->formatted_size ?? '-' }}</p>
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ $item->file_url ?? '#' }}" target="_blank" class="btn btn-xs btn-outline-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.albums.items.destroy', [$album, $item]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-outline-danger" 
                                                    onclick="return confirm('Yakin ingin menghapus item ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($items->hasPages())
                    <div class="mt-3">
                        {{ $items->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h5>Belum ada item di album ini</h5>
                    <p class="text-muted">Upload foto atau video untuk memulai.</p>
                    <a href="{{ route('admin.albums.items.create', $album) }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah Item Pertama
                    </a>
                </div>
            @endif
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

@section('js')
    <script>
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
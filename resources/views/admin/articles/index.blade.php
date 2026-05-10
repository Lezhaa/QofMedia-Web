@extends('adminlte::page')

@section('title', 'Manajemen Artikel')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Manajemen Artikel</h1>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Artikel
        </a>
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
                        <th width="50">#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal Publish</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $article->title }}</td>
                            <td><span class="badge badge-info">{{ $article->category }}</span></td>
                            <td>
                                @if($article->published_at)
                                    {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('information.show', $article->slug) }}" class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-newspaper fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada artikel</p>
                                <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Tambah Artikel
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($articles->hasPages())
            <div class="card-footer">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@stop
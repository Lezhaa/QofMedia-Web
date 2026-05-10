@extends('adminlte::page')

@section('title', 'Pesan Kontak')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Pesan Kontak</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary" target="_blank">
            <i class="fas fa-globe"></i> Lihat Website
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
        <div class="card-header">
            <h3 class="card-title">Daftar Pesan Masuk</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="50">Status</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Tanggal</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr class="{{ $contact->read_at ? '' : 'table-warning' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($contact->read_at)
                                    <span class="badge badge-success" title="Sudah dibaca">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @else
                                    <span class="badge badge-warning" title="Belum dibaca">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $contact->name }}</strong>
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                @if(!$contact->read_at)
                                    <form action="{{ route('admin.contacts.read', $contact) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Tandai sudah dibaca">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-envelope-open-text fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada pesan masuk</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($contacts->hasPages())
            <div class="card-footer">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
@stop
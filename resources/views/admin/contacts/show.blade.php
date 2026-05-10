@extends('adminlte::page')

@section('title', 'Detail Pesan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Detail Pesan</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Pesan Kontak</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
        <div>
            @if(!$contact->read_at)
                <form action="{{ route('admin.contacts.read', $contact) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Tandai Sudah Dibaca
                    </button>
                </form>
            @endif
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Isi Pesan</h3>
                </div>
                <div class="card-body">
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($contact->message)) !!}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pengirim</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="100">Nama</th>
                            <td>: {{ $contact->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>: 
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank">
                                    {{ $contact->phone }}
                                    <i class="fab fa-whatsapp text-success"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>: {{ $contact->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:
                                @if($contact->read_at)
                                    <span class="badge badge-success">
                                        Dibaca pada {{ $contact->read_at->format('d M Y H:i') }}
                                    </span>
                                @else
                                    <span class="badge badge-warning">Belum Dibaca</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="mailto:{{ $contact->email }}" class="btn btn-primary">
                            <i class="fas fa-reply"></i> Balas via Email
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
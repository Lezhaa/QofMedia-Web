@extends('adminlte::page')

@section('content')
<div class="text-center py-5">
    <h2>Sesi Expired</h2>
    <p class="text-muted">Halaman sudah terlalu lama dibuka. Silakan kembali dan coba lagi.</p>
    <a href="javascript:history.back()" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
@stop
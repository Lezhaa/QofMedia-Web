@extends('adminlte::page')

@section('title', 'Kelola Varian')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Varian Kaos</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus"></i> Tambah Varian
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
                        <th>Model</th>
                        <th>Size</th>
                        <th>Warna</th>
                        <th>Lengan</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($variants as $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $v->model->name ?? 'N/A' }}</td>
                            <td><span class="badge badge-primary">{{ $v->size }}</span></td>
                            <td>{{ $v->color }}</td>
                            <td>{{ $v->sleeve_type == 'pendek' ? 'Pendek' : 'Panjang' }}</td>
                            <td>{{ $v->stock }}</td>
                            <td>Rp {{ number_format($v->price, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn" 
                                        data-id="{{ $v->id }}"
                                        data-model="{{ $v->model_id }}"
                                        data-size="{{ $v->size }}"
                                        data-color="{{ $v->color }}"
                                        data-sleeve="{{ $v->sleeve_type }}"
                                        data-stock="{{ $v->stock }}"
                                        data-price="{{ $v->price }}"
                                        data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('apparel.variants.destroy', $v) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-4">Belum ada varian</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($variants->hasPages())
            <div class="card-footer">{{ $variants->links() }}</div>
        @endif
    </div>

    {{-- Modal Tambah Bulk --}}
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('apparel.variants.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Tambah Varian Sekaligus</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Model/Motif</label>
                                <select id="bulkModel" class="form-control">
                                    <option value="">Pilih Model</option>
                                    @foreach($models as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->edition->name ?? '' }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Size</label>
                                <select id="bulkSize" class="form-control">
                                    <option value="">Pilih</option>
                                    <option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Lengan</label>
                                <select id="bulkSleeve" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="pendek">Pendek</option>
                                    <option value="panjang">Panjang</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Stok Default</label>
                                <input type="number" id="bulkStock" class="form-control" value="10">
                            </div>
                            <div class="col-md-2">
                                <label>Harga Default</label>
                                <input type="number" id="bulkPrice" class="form-control" value="90000">
                            </div>
                        </div>
                        <button type="button" class="btn btn-info mb-3" onclick="addBulkRow()">
                            <i class="fas fa-plus"></i> Tambah Baris
                        </button>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="bulkTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="200">Model</th>
                                        <th width="70">Size</th>
                                        <th width="90">Lengan</th>
                                        <th width="130">Warna</th>
                                        <th width="80">Stok</th>
                                        <th width="130">Harga</th>
                                        <th width="50">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="bulkTableBody">
                                    <tr id="emptyRow">
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-info-circle"></i> 
                                            Pilih Model, Size, Lengan, isi Stok & Harga default, lalu klik <b>Tambah Baris</b>. 
                                            Isi warna untuk setiap baris.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="text-muted mr-auto" id="rowCount">0 varian</span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Semua
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-content">
                    <div class="modal-header"><h5>Edit Varian</h5></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Model</label>
                            <select name="model_id" id="editModel" class="form-control" required>
                                @foreach($models as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Size</label>
                                    <select name="size" id="editSize" class="form-control" required>
                                        <option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Warna</label>
                                    <input type="text" name="color" id="editColor" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lengan</label>
                            <select name="sleeve_type" id="editSleeve" class="form-control" required>
                                <option value="pendek">Pendek</option>
                                <option value="panjang">Panjang</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" name="stock" id="editStock" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="price" id="editPrice" class="form-control" required>
                                </div>
                            </div>
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
    function addBulkRow() {
        const model = document.getElementById('bulkModel');
        const size = document.getElementById('bulkSize');
        const sleeve = document.getElementById('bulkSleeve');
        const stock = document.getElementById('bulkStock');
        const price = document.getElementById('bulkPrice');
        
        if (!model.value || !size.value || !sleeve.value) {
            alert('Pilih Model, Size, dan Lengan terlebih dahulu!');
            return;
        }
        
        const modelText = model.options[model.selectedIndex].text;
        const sizeText = size.value;
        const sleeveText = sleeve.value === 'pendek' ? 'Pendek' : 'Panjang';
        
        document.getElementById('emptyRow')?.remove();
        
        const tbody = document.getElementById('bulkTableBody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                ${modelText}
                <input type="hidden" name="model_id[]" value="${model.value}">
            </td>
            <td>
                <span class="badge badge-primary">${sizeText}</span>
                <input type="hidden" name="size[]" value="${sizeText}">
            </td>
            <td>
                ${sleeveText}
                <input type="hidden" name="sleeve_type[]" value="${sleeve.value}">
            </td>
            <td>
                <input type="text" name="color[]" class="form-control form-control-sm" placeholder="Contoh: Hitam" required>
            </td>
            <td>
                <input type="number" name="stock[]" class="form-control form-control-sm" value="${stock.value}" required>
            </td>
            <td>
                <input type="number" name="price[]" class="form-control form-control-sm" value="${price.value}" required>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
        updateRowCount();
    }
    
    function removeRow(btn) {
        btn.closest('tr').remove();
        updateRowCount();
        if (document.getElementById('bulkTableBody').children.length === 0) {
            document.getElementById('bulkTableBody').innerHTML = `
                <tr id="emptyRow">
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="fas fa-info-circle"></i> 
                        Pilih Model, Size, Lengan, isi Stok & Harga default, lalu klik <b>Tambah Baris</b>.
                    </td>
                </tr>
            `;
        }
    }
    
    function updateRowCount() {
        const count = document.querySelectorAll('#bulkTableBody tr:not(#emptyRow)').length;
        document.getElementById('rowCount').textContent = count + ' varian';
    }

    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        $('#editModel').val($(this).data('model'));
        $('#editSize').val($(this).data('size'));
        $('#editColor').val($(this).data('color'));
        $('#editSleeve').val($(this).data('sleeve'));
        $('#editStock').val($(this).data('stock'));
        $('#editPrice').val($(this).data('price'));
        $('#editForm').attr('action', '/apparel/variants/' + id);
    });
</script>
@stop
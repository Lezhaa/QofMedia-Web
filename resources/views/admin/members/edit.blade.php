@extends('adminlte::page')

@section('title', 'Edit Anggota: ' . $member->name)

@section('content_header')
    <div>
        <h1>Edit Anggota: {{ $member->name }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.members.index') }}">Anggota Tim</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.members.update', $member) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- Nama Lengkap -->
                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $member->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Nickname -->
                        <div class="form-group">
                            <label for="nickname">Nama Panggilan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nickname') is-invalid @enderror" 
                                   id="nickname" name="nickname" value="{{ old('nickname', $member->nickname) }}" required>
                            @error('nickname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Position -->
                        <div class="form-group">
                            <label for="position">Posisi/Jabatan</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                   id="position" name="position" value="{{ old('position', $member->position) }}" 
                                   placeholder="Contoh: Ketua Divisi, Staff Kreatif">
                            @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Divisi -->
                        <div class="form-group">
                            <label>Divisi <span class="text-danger">*</span></label>
                            <div class="row">
                                @foreach($divisions as $div)
                                    <div class="col-md-4 mb-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" 
                                                id="div_{{ $div->id }}" name="division_ids[]" 
                                                value="{{ $div->id }}"
                                                {{ in_array($div->id, old('division_ids', $selectedDivisions)) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="div_{{ $div->id }}">
                                                {{ $div->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('division_ids') 
                                <small class="text-danger">{{ $message }}</small> 
                            @enderror
                            <small class="form-text text-muted">Bisa pilih lebih dari satu divisi.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Media Sosial (Flexible) -->
                        <div class="form-group">
                            <label>Media Sosial (Opsional)</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="social_platform" class="form-control" id="socialPlatform">
                                        <option value="">-- Pilih Platform --</option>
                                        <option value="instagram" {{ old('social_platform', $member->social_platform) == 'instagram' ? 'selected' : '' }}>
                                            📷 Instagram
                                        </option>
                                        <option value="twitter" {{ old('social_platform', $member->social_platform) == 'twitter' ? 'selected' : '' }}>
                                            🐦 Twitter / X
                                        </option>
                                        <option value="linkedin" {{ old('social_platform', $member->social_platform) == 'linkedin' ? 'selected' : '' }}>
                                            🔗 LinkedIn
                                        </option>
                                        <option value="github" {{ old('social_platform', $member->social_platform) == 'github' ? 'selected' : '' }}>
                                            💻 GitHub
                                        </option>
                                        <option value="tiktok" {{ old('social_platform', $member->social_platform) == 'tiktok' ? 'selected' : '' }}>
                                            🎵 TikTok
                                        </option>
                                        <option value="facebook" {{ old('social_platform', $member->social_platform) == 'facebook' ? 'selected' : '' }}>
                                            👍 Facebook
                                        </option>
                                        <option value="youtube" {{ old('social_platform', $member->social_platform) == 'youtube' ? 'selected' : '' }}>
                                            ▶️ YouTube
                                        </option>
                                        <option value="whatsapp" {{ old('social_platform', $member->social_platform) == 'whatsapp' ? 'selected' : '' }}>
                                            💬 WhatsApp
                                        </option>
                                        <option value="telegram" {{ old('social_platform', $member->social_platform) == 'telegram' ? 'selected' : '' }}>
                                            ✈️ Telegram
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" 
                                           name="social_username" 
                                           class="form-control @error('social_username') is-invalid @enderror" 
                                           id="socialUsername"
                                           placeholder="Contoh: @username atau link lengkap"
                                           value="{{ old('social_username', $member->social_username) }}">
                                    @error('social_username') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>
                            <small class="form-text text-muted" id="socialHint">
                                Pilih platform lalu masukkan username (tanpa @) atau link lengkap
                            </small>
                        </div>

                        <!-- Foto Saat Ini -->
                        <div class="form-group">
                            <label>Foto Saat Ini</label>
                            <div>
                                @if($member->photo_url)
                                    <img src="{{ $member->photo_url }}" style="max-width: 120px; border-radius: 12px; border: 2px solid #e2e8f0;">
                                    <br><small class="text-muted">Kosongkan input di bawah jika tidak ingin mengganti</small>
                                @else
                                    <div style="width: 120px; height: 120px; border-radius: 12px; background: #6366f1; display: flex; align-items: center; justify-content: center;">
                                        <span style="color: white; font-weight: 700; font-size: 40px;">
                                            {{ strtoupper(substr($member->nickname, 0, 1)) }}
                                        </span>
                                    </div>
                                    <br><small class="text-muted">Belum ada foto</small>
                                @endif
                            </div>
                        </div>

                        <!-- Ganti Foto -->
                        <div class="form-group">
                            <label for="photo">Ganti Foto</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                   id="photo" name="photo" accept="image/*">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti. JPG, PNG max 2MB.</small>
                            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Urutan & Status -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order">Urutan Tampil</label>
                                    <input type="number" class="form-control" id="order" name="order" 
                                           value="{{ old('order', $member->order) }}" min="0">
                                    <small class="form-text text-muted">Semakin kecil semakin atas</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', $member->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $member->is_active) == '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Update Anggota
                    </button>
                    <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('js')
    <script>
        const platformSelect = document.getElementById('socialPlatform');
        const usernameInput = document.getElementById('socialUsername');
        const hintText = document.getElementById('socialHint');

        const platformConfig = {
            'instagram': { placeholder: '@username', hint: 'Masukkan username Instagram (tanpa @), contoh: johndoe' },
            'twitter': { placeholder: '@username', hint: 'Masukkan username Twitter/X (tanpa @), contoh: johndoe' },
            'linkedin': { placeholder: 'https://linkedin.com/in/username', hint: 'Masukkan link profil LinkedIn lengkap' },
            'github': { placeholder: 'username', hint: 'Masukkan username GitHub, contoh: johndoe' },
            'tiktok': { placeholder: '@username', hint: 'Masukkan username TikTok (tanpa @), contoh: johndoe' },
            'facebook': { placeholder: 'username', hint: 'Masukkan username Facebook, contoh: johndoe' },
            'youtube': { placeholder: '@username', hint: 'Masukkan username YouTube (tanpa @), contoh: johndoe' },
            'whatsapp': { placeholder: '6281234567890', hint: 'Masukkan nomor WhatsApp dengan kode negara, contoh: 6281234567890' },
            'telegram': { placeholder: '@username/username', hint: 'Masukkan username Telegram (tanpa @), contoh: johndoe' }
        };

        platformSelect.addEventListener('change', function() {
            const platform = this.value;
            const config = platformConfig[platform];
            
            if (config) {
                usernameInput.placeholder = config.placeholder;
                hintText.textContent = config.hint;
            } else {
                usernameInput.placeholder = 'username atau link';
                hintText.textContent = 'Masukkan username atau link media sosial';
            }
        });
        
        if (platformSelect.value) {
            platformSelect.dispatchEvent(new Event('change'));
        }
    </script>
    @endpush
@stop
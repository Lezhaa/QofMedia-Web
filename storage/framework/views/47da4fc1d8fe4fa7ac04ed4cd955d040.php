

<?php $__env->startSection('title', 'Tambah Anggota Tim'); ?>

<?php $__env->startSection('content_header'); ?>
    <div>
        <h1>Tambah Anggota Tim</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.members.index')); ?>">Anggota Tim</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('admin.members.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- Nama Lengkap -->
                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="name" name="name" value="<?php echo e(old('name')); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Nickname -->
                        <div class="form-group">
                            <label for="nickname">Nama Panggilan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nickname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="nickname" name="nickname" value="<?php echo e(old('nickname')); ?>" required>
                            <?php $__errorArgs = ['nickname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Position -->
                        <div class="form-group">
                            <label for="position">Posisi/Jabatan</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="position" name="position" value="<?php echo e(old('position')); ?>" 
                                   placeholder="Contoh: Ketua Divisi, Staff Kreatif">
                            <?php $__errorArgs = ['position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Divisi -->
                        <div class="form-group">
                            <label>Divisi <span class="text-danger">*</span></label>
                            <div class="row">
                                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 mb-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" 
                                                id="div_<?php echo e($div->id); ?>" name="division_ids[]" 
                                                value="<?php echo e($div->id); ?>"
                                                <?php echo e(in_array($div->id, old('division_ids', [])) ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="div_<?php echo e($div->id); ?>">
                                                <?php echo e($div->name); ?>

                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['division_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                <small class="text-danger"><?php echo e($message); ?></small> 
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                        <option value="instagram" <?php echo e(old('social_platform') == 'instagram' ? 'selected' : ''); ?>>
                                            📷 Instagram
                                        </option>
                                        <option value="twitter" <?php echo e(old('social_platform') == 'twitter' ? 'selected' : ''); ?>>
                                            🐦 Twitter / X
                                        </option>
                                        <option value="linkedin" <?php echo e(old('social_platform') == 'linkedin' ? 'selected' : ''); ?>>
                                            🔗 LinkedIn
                                        </option>
                                        <option value="github" <?php echo e(old('social_platform') == 'github' ? 'selected' : ''); ?>>
                                            💻 GitHub
                                        </option>
                                        <option value="tiktok" <?php echo e(old('social_platform') == 'tiktok' ? 'selected' : ''); ?>>
                                            🎵 TikTok
                                        </option>
                                        <option value="facebook" <?php echo e(old('social_platform') == 'facebook' ? 'selected' : ''); ?>>
                                            👍 Facebook
                                        </option>
                                        <option value="youtube" <?php echo e(old('social_platform') == 'youtube' ? 'selected' : ''); ?>>
                                            ▶️ YouTube
                                        </option>
                                        <option value="whatsapp" <?php echo e(old('social_platform') == 'whatsapp' ? 'selected' : ''); ?>>
                                            💬 WhatsApp
                                        </option>
                                        <option value="telegram" <?php echo e(old('social_platform') == 'telegram' ? 'selected' : ''); ?>>
                                            ✈️ Telegram
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" 
                                           name="social_username" 
                                           class="form-control <?php $__errorArgs = ['social_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="socialUsername"
                                           placeholder="Contoh: @username atau link lengkap"
                                           value="<?php echo e(old('social_username')); ?>">
                                    <?php $__errorArgs = ['social_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                        <div class="invalid-feedback"><?php echo e($message); ?></div> 
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <small class="form-text text-muted" id="socialHint">
                                Pilih platform lalu masukkan username (tanpa @) atau link lengkap
                            </small>
                        </div>

                        <!-- Foto -->
                        <div class="form-group">
                            <label for="photo">Foto Profil</label>
                            <input type="file" class="form-control <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="photo" name="photo" accept="image/*">
                            <small class="form-text text-muted">JPG, PNG. Maks 2MB. Ukuran ideal 300x400px.</small>
                            <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Urutan & Status -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order">Urutan Tampil</label>
                                    <input type="number" class="form-control" id="order" name="order" 
                                           value="<?php echo e(old('order', 0)); ?>" min="0">
                                    <small class="form-text text-muted">Semakin kecil semakin atas</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1" <?php echo e(old('is_active', 1) == '1' ? 'selected' : ''); ?>>Aktif</option>
                                        <option value="0" <?php echo e(old('is_active') == '0' ? 'selected' : ''); ?>>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                    <a href="<?php echo e(route('admin.members.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('js'); ?>
    <script>
        // Dynamic placeholder untuk media sosial
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
            'telegram': { placeholder: '@username', hint: 'Masukkan username Telegram (tanpa @), contoh: johndoe' }
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
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/members/create.blade.php ENDPATH**/ ?>
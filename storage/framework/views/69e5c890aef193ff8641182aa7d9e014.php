<?php $__env->startSection('title', 'Edit Informasi Toko'); ?>
<?php $__env->startSection('content'); ?>
<div class="mx-auto max-w-4xl">
    <a href="<?php echo e(route('tentang.index')); ?>" class="mb-5 inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-600"><i data-lucide="arrow-left" class="h-4 w-4"></i> Kembali ke Tentang Toko</a>
    <h1 class="text-3xl font-bold text-slate-900">Edit Informasi Toko</h1>
    <p class="mt-2 mb-6 text-sm text-slate-500">Perbarui informasi yang akan ditampilkan kepada pengguna aplikasi.</p>
    <?php if($errors->any()): ?>
        <div role="alert" class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">Perubahan belum disimpan. Periksa kolom yang ditandai di bawah.</div>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(route('tentang.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php
            $sections = [
                'Identitas Toko' => ['nama_toko' => 'Nama Toko', 'tagline' => 'Tagline', 'deskripsi' => 'Profil Toko'],
                'Cerita & Tujuan' => ['sejarah' => 'Sejarah Toko', 'visi' => 'Visi', 'misi' => 'Misi', 'produk_layanan' => 'Produk & Layanan'],
                'Alamat & Kontak' => ['alamat' => 'Alamat Toko', 'telepon' => 'Nomor Telepon', 'email' => 'Email'],
            ];
            $shortFields = ['nama_toko', 'tagline', 'telepon', 'email'];
        ?>
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-lg font-bold text-slate-900"><?php echo e($section); ?></h2>
                <div class="space-y-5">
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <label for="<?php echo e($field); ?>" class="mb-2 block text-sm font-semibold text-slate-700"><?php echo e($label); ?> <?php if($field === 'nama_toko'): ?><span class="text-rose-500">*</span><?php endif; ?></label>
                            <?php if(in_array($field, $shortFields)): ?>
                                <input id="<?php echo e($field); ?>" name="<?php echo e($field); ?>" type="<?php echo e($field === 'email' ? 'email' : ($field === 'telepon' ? 'tel' : 'text')); ?>" value="<?php echo e(old($field, $toko->$field)); ?>" maxlength="<?php echo e($field === 'telepon' ? 30 : 255); ?>" <?php if($field === 'nama_toko'): echo 'required'; endif; ?> class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            <?php else: ?>
                                <textarea id="<?php echo e($field); ?>" name="<?php echo e($field); ?>" rows="<?php echo e($field === 'alamat' ? 3 : 5); ?>" maxlength="<?php echo e($field === 'alamat' ? 2000 : 10000); ?>" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm leading-6 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100"><?php echo e(old($field, $toko->$field)); ?></textarea>
                            <?php endif; ?>
                            <?php if(in_array($field, ['misi', 'produk_layanan'])): ?><p class="mt-1 text-xs text-slate-500">Tulis satu poin per baris agar tampil sebagai daftar.</p><?php endif; ?>
                            <?php $__errorArgs = [$field];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-sm text-rose-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="flex flex-wrap justify-end gap-3">
            <a href="<?php echo e(route('tentang.index')); ?>" class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50">Batal</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700"><i data-lucide="save" class="h-4 w-4"></i> Simpan Perubahan</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\k5_mart\resources\views/tentang/edit.blade.php ENDPATH**/ ?>
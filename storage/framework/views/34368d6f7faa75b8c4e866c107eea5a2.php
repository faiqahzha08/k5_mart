<?php $__env->startSection('title', 'Jenis Produk - K5 Mart'); ?>

<?php $__env->startSection('content'); ?>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
            Jenis Produk
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Kelola jenis atau kategori produk
        </p>
    </div>

    <?php if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin'): ?>
    <a href="<?php echo e(route('jenis-produk.create')); ?>"
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition shadow-sm">

        <i data-lucide="plus" class="w-4 h-4"></i>

        Tambah Jenis Produk

    </a>
    <?php endif; ?>

</div>


<!-- Success -->
<?php if(session('success')): ?>

    <div class="mb-6 px-4 py-3 rounded-xl bg-green-100 border border-green-200 text-green-700 text-sm">
        <?php echo e(session('success')); ?>

    </div>

<?php endif; ?>


<!-- Error -->
<?php if(session('error')): ?>

    <div class="mb-6 px-4 py-3 rounded-xl bg-red-100 border border-red-200 text-red-700 text-sm">
        <?php echo e(session('error')); ?>

    </div>

<?php endif; ?>


<!-- Table -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <!-- Header Table -->
            <thead>

                <tr class="bg-slate-50 border-b border-slate-200">

                    <th class="px-6 py-4 text-left font-semibold text-slate-700">
                        #
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-slate-700">
                        Nama Jenis Produk
                    </th>

                    <th class="px-6 py-4 text-center font-semibold text-slate-700">
                        Jumlah Produk
                    </th>

                    <?php if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin'): ?>
                    <th class="px-6 py-4 text-right font-semibold text-slate-700">
                        Aksi
                    </th>
                    <?php endif; ?>

                </tr>

            </thead>


            <!-- Body Table -->
            <tbody class="divide-y divide-slate-100">

                <?php $__empty_1 = true; $__currentLoopData = $jenisProduks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr class="hover:bg-slate-50 transition">

                        <!-- Nomor -->
                        <td class="px-6 py-4 text-slate-600">
                            <?php echo e($index + 1); ?>

                        </td>


                        <!-- Nama Jenis -->
                        <td class="px-6 py-4">

                            <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-medium">

                                <?php echo e($jenis->nama); ?>


                            </span>

                        </td>


                        <!-- Jumlah Produk -->
                        <td class="px-6 py-4 text-center">

                            <?php if($jenis->produks_count > 0): ?>

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">

                                    <?php echo e($jenis->produks_count); ?> produk

                                </span>

                            <?php else: ?>

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium">

                                    0 produk

                                </span>

                            <?php endif; ?>

                        </td>


                        <?php if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin'): ?>
                        <!-- Aksi -->
                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-2">

                                <!-- Edit -->
                                <a href="<?php echo e(route('jenis-produk.edit', $jenis->id)); ?>"
                                   title="Edit Jenis Produk"
                                   class="p-2 rounded-lg bg-yellow-100 hover:bg-yellow-200 transition">

                                    <i data-lucide="pencil"
                                       class="w-4 h-4 text-yellow-700"></i>

                                </a>


                                <!-- Hapus -->
                                <form action="<?php echo e(route('jenis-produk.destroy', $jenis->id)); ?>"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus jenis produk <?php echo e($jenis->nama); ?>?')">

                                    <?php echo csrf_field(); ?>

                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit"
                                            title="Hapus Jenis Produk"
                                            class="p-2 rounded-lg bg-red-100 hover:bg-red-200 transition">

                                        <i data-lucide="trash-2"
                                           class="w-4 h-4 text-red-700"></i>

                                    </button>

                                </form>

                            </div>

                        </td>
                        <?php endif; ?>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <!-- Data Kosong -->
                    <tr>

                        <td colspan="<?php echo e(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin' ? 4 : 3); ?>"
                            class="px-6 py-12 text-center">

                            <div class="flex flex-col items-center justify-center">

                                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-3">

                                    <i data-lucide="folder"
                                       class="w-7 h-7 text-slate-400"></i>

                                </div>

                                <p class="text-slate-600 font-medium">
                                    Belum ada jenis produk
                                </p>

                                <p class="text-sm text-slate-400 mt-1">
                                    Silakan tambahkan jenis produk baru.
                                </p>

                                <?php if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin'): ?>
                                <a href="<?php echo e(route('jenis-produk.create')); ?>"
                                   class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded-xl transition">

                                    <i data-lucide="plus" class="w-4 h-4"></i>

                                    Tambah Jenis Produk

                                </a>
                                <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\k5_mart\resources\views/jenis_produk/index.blade.php ENDPATH**/ ?>
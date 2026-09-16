<?php $__env->startSection('title', 'User - K5 Mart'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Manajemen User</h1>
            <p class="mt-1 text-sm text-slate-500">
                Kelola akun pengguna sistem POS
            </p>
        </div>

        <a href="<?php echo e(route('user.create')); ?>"
            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700 transition">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah User
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Role</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4">
                                <?php echo e($index + 1); ?>

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-500 text-white font-semibold">

                                        <?php echo e(strtoupper(substr($user->name,0,1))); ?>


                                    </div>

                                    <div>
                                        <div class="font-medium text-slate-800">
                                            <?php echo e($user->name); ?>

                                        </div>
                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e($user->email); ?>

                            </td>

                            <td class="px-6 py-4">

                                <?php
                                    $role = $user->role?->nama ?? 'User';
                                ?>

                                <?php if(strtolower($role) == 'admin'): ?>

                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">
                                        Admin
                                    </span>

                                <?php elseif(strtolower($role) == 'kasir'): ?>

                                    <span
                                        class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Kasir
                                    </span>

                                <?php else: ?>

                                    <span
                                        class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                        <?php echo e($role); ?>

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    <a href="<?php echo e(route('user.edit',$user->id)); ?>"
                                        class="rounded-lg p-2 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600">

                                        <i data-lucide="pencil" class="w-4 h-4"></i>

                                    </a>

                                    <?php if(auth()->id() != $user->id): ?>

                                        <form action="<?php echo e(route('user.destroy',$user->id)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                class="rounded-lg p-2 text-slate-500 hover:bg-red-50 hover:text-red-600">

                                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                                            </button>

                                        </form>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="5" class="py-16 text-center text-slate-500">

                                Belum ada data user.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\k5_mart\resources\views/users/index.blade.php ENDPATH**/ ?>
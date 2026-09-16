<?php $__env->startSection('title', 'Profile'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-5xl mx-auto">

    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">
            Profile
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Informasi akun pengguna
        </p>
    </div>


    
    <?php if(session('success')): ?>

        <div class="mb-6 flex items-center gap-3
                    rounded-xl border border-green-200
                    bg-green-50 px-5 py-4
                    text-sm text-green-700">

            <i data-lucide="check-circle"
               class="h-5 w-5">
            </i>

            <span>
                <?php echo e(session('success')); ?>

            </span>

        </div>

    <?php endif; ?>


    
    <div class="overflow-hidden rounded-2xl
                border border-slate-200
                bg-white shadow-sm">


        
        <div class="h-32 bg-gradient-to-r
                    from-indigo-600 to-purple-600">
        </div>


        <div class="px-8 pb-8">


            
            <div class="-mt-12 mb-6">

                <div class="flex h-24 w-24
                            items-center justify-center
                            rounded-2xl
                            border-4 border-white
                            bg-indigo-600
                            shadow-lg">

                    <i data-lucide="user"
                       class="h-12 w-12 text-white">
                    </i>

                </div>

            </div>


            
            <div class="flex flex-col gap-5
                        md:flex-row
                        md:items-start
                        md:justify-between">


                <div>

                    
                    <h2 class="text-2xl font-bold
                               text-slate-900">

                        <?php echo e($user->name); ?>


                    </h2>


                    
                    <p class="mt-1 text-slate-500">

                        <?php echo e($user->email); ?>


                    </p>


                    
                    <div class="mt-3 inline-flex
                                items-center gap-2
                                rounded-full
                                bg-indigo-50
                                px-3 py-1.5
                                text-sm font-medium
                                text-indigo-600">

                        <i data-lucide="shield"
                           class="h-4 w-4">
                        </i>

                        <?php echo e(ucfirst($user->role->nama ?? 'User')); ?>


                    </div>

                </div>


                
                <a href="<?php echo e(route('profile.edit')); ?>"
                   class="inline-flex
                          items-center
                          justify-center
                          gap-2 rounded-xl
                          bg-indigo-600
                          px-5 py-2.5
                          font-medium text-white
                          transition
                          hover:bg-indigo-700">

                    <i data-lucide="edit-3"
                       class="h-4 w-4">
                    </i>

                    Edit Profile

                </a>

            </div>


            
            <hr class="my-8 border-slate-200">


            
            <div>

                <h3 class="mb-5 text-lg font-bold
                           text-slate-900">

                    Informasi Akun

                </h3>


                <div class="grid grid-cols-1
                            gap-5 md:grid-cols-2">


                    
                    <div class="rounded-xl
                                bg-slate-50 p-5">

                        <div class="mb-2 flex
                                    items-center gap-3">

                            <div class="flex h-9 w-9
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-indigo-100">

                                <i data-lucide="user"
                                   class="h-5 w-5
                                          text-indigo-600">
                                </i>

                            </div>

                            <span class="text-sm
                                         text-slate-500">

                                Nama Lengkap

                            </span>

                        </div>

                        <p class="font-semibold
                                  text-slate-900">

                            <?php echo e($user->name); ?>


                        </p>

                    </div>


                    
                    <div class="rounded-xl
                                bg-slate-50 p-5">

                        <div class="mb-2 flex
                                    items-center gap-3">

                            <div class="flex h-9 w-9
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-blue-100">

                                <i data-lucide="mail"
                                   class="h-5 w-5
                                          text-blue-600">
                                </i>

                            </div>

                            <span class="text-sm
                                         text-slate-500">

                                Email

                            </span>

                        </div>

                        <p class="font-semibold
                                  text-slate-900">

                            <?php echo e($user->email); ?>


                        </p>

                    </div>


                    
                    <div class="rounded-xl
                                bg-slate-50 p-5">

                        <div class="mb-2 flex
                                    items-center gap-3">

                            <div class="flex h-9 w-9
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-purple-100">

                                <i data-lucide="shield-check"
                                   class="h-5 w-5
                                          text-purple-600">
                                </i>

                            </div>

                            <span class="text-sm
                                         text-slate-500">

                                Role

                            </span>

                        </div>

                        <p class="font-semibold
                                  text-slate-900">

                            <?php echo e(ucfirst($user->role->nama ?? 'User')); ?>


                        </p>

                    </div>


                    
                    <div class="rounded-xl
                                bg-slate-50 p-5">

                        <div class="mb-2 flex
                                    items-center gap-3">

                            <div class="flex h-9 w-9
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-green-100">

                                <i data-lucide="calendar"
                                   class="h-5 w-5
                                          text-green-600">
                                </i>

                            </div>

                            <span class="text-sm
                                         text-slate-500">

                                Bergabung Sejak

                            </span>

                        </div>

                        <p class="font-semibold
                                  text-slate-900">

                            <?php echo e($user->created_at
                                ? $user->created_at->format('d M Y')
                                : '-'); ?>


                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\K5_Mart\resources\views/profile/index.blade.php ENDPATH**/ ?>
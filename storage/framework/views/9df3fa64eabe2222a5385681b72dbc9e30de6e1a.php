
<?php $__env->startSection('content'); ?>
    <h1>Formação dos times</h1>
    <form action="<?php echo e(url('/createteams')); ?>"  method="POST" >
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Qtde de Jogadores por times</label>
            <input name="players" size="10" value="<?php if(isset($data['players'])): ?> <?php echo e($data['players']); ?> <?php endif; ?>" />
        </div>
        <div class="form-group">
            <button type="submit">Executar</button>
        </div>
    </form>

    <div class="container">
        <div class="teams">
        <?php if(isset($data['team'])): ?>
            <?php $__currentLoopData = $data['team']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="team">
                    <ul>
                        <li class="player"><label>Goleiro</label></li>
                        <li><label><?php echo e(count($team['Goalkeeper']) > 0 ? $team['Goalkeeper'][0] : ""); ?></label></li>
                        <li class="player"><label>Jogadores</label></li>
                    <?php if( count($team['Players']) > 0 ): ?>
                            <?php $__currentLoopData = $team['Players']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="players"><label><?php echo e($player); ?></label></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    </ul>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label><?php if(isset($data['message'])): ?> <?php echo e($data['message']); ?> <?php endif; ?></label>
    </div>
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><label><?php echo e($error); ?></label></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center">
            <div class="ml-4 text-lg leading-7 font-semibold"><a href="/" class="underline text-gray-900 dark:text-white">Página inicial</a></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\http\players\resources\views//players/teams.blade.php ENDPATH**/ ?>
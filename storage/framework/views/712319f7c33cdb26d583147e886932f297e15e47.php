
<?php $__env->startSection('content'); ?>
        <h1>Posições</h1>
        <br /><!-- comment -->
        <table class="table">
            <?php if(count($positions) > 0): ?>
                <tr>
                    <td>Posição</td>
                    <td>Descrição</td>
                    <td>Criando em</td>
                </tr>
                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($p->shortname); ?></td>
                    <td><?php echo e($p->name); ?></td>
                    <td><?php echo e(date('d/m/Y h:i:s', $p->created_at)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td>Sem posições</td>
                </tr>
            <?php endif; ?>
        </table>
        <br /><!-- comment -->
                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center">
            <div class="ml-4 text-lg leading-7 font-semibold"><a href="/" class="underline text-gray-900 dark:text-white">Página inicial</a></div>
        </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\http\players\resources\views//positions/listagem.blade.php ENDPATH**/ ?>
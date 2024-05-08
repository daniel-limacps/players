
<?php $__env->startSection('content'); ?>
        <h1>Formação</h1>
        <br />
        <table class="table">
            <?php
            if(count($training) > 0){?>
                <tr>
                    <td>Formação</td>
                    <td>Descrição</td>
                    <td>Criando em</td>
                </tr>
                <?php foreach ($training as $t){?>
                <tr>
                    <td><?php echo $t->training ?> </td>
                    <td><?php echo $t->description ?> </td>
                    <td><?php echo date('d/m/Y h:i:s', $t->created_at)?> </td>
                </tr>
                <?php }
            } else { ?>
                <tr>
                    <td>Sem formação de jogo</td>
                </tr>
            <?php } ?>
        </table>
        <br /><!-- comment -->
        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 font-semibold"><a href="/" class="underline text-gray-900 dark:text-white">Página inicial</a></div>
            </div>
        </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\http\players\resources\views//training/listagem.blade.php ENDPATH**/ ?>
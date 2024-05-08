<?php $__env->startSection('content'); ?>
    <h1>Novo Jogador</h1>
        <form action="/player/store"  method="POST" >
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label>Nome</label>
                <input name="name" size="50" />
            </div>
            <div class="form-group">
                <label>Nivel</label>
                <select name="nivel">
                    <option value="">Selecione</option>
                    <?php for($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Goleiro</label>
                <input name="goalkeeper" type ="checkbox" value="1" />
            </div>
            <div class="form-group">
                <button type="submit">Salvar</button>
            </div>
            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="ml-4 text-lg leading-7 font-semibold"><a href="/player" class="underline text-gray-900 dark:text-white">Voltar</a></div>
                </div>
            </div>
        </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\http\players\resources\views//players/addplayer.blade.php ENDPATH**/ ?>
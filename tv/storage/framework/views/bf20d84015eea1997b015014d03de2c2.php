<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <?php echo e(__('Carga de imágenes')); ?>

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#nuevoModal">Nuevo</button>

                        <!-- Modal -->
                        <div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog"
                            aria-labelledby="nuevoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="nuevoModalLabel">Cargar Imagen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo e(route('guardar-imagen')); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="file" name="imagen">
                                            <button type="submit" class="btn btn-primary">Subir Imagen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>URL</th>
                                    <th>Miniatura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($registro->id); ?> </td>
                                        <td> <?php echo e($registro->nombre); ?> </td>
                                        <td> <?php echo e($registro->url); ?> </td>
                                        <td> <img src="<?php echo e(asset($registro->url)); ?>" width="100" height="100"></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <!-- Incluye jQuery -->

    <!-- Incluye los scripts de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tv\resources\views/subir-imagen.blade.php ENDPATH**/ ?>
<div id="detail_producto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            <div>Agregar Producto</div>
        </div>
        <div class="modal-body">
            <div class="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#producto_1" data-toggle="tab">1. Descripción</a></li>
                    <li><a href="#producto_2" data-toggle="tab">2. Imágenes</a></li>
                    <li><a href="#producto_3" data-toggle="tab">3. Inventario</a></li>
                    <li><a href="#producto_4" data-toggle="tab">4. Atributos</a></li>
                    <li><a href="#producto_5" data-toggle="tab">5. Vinculación</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel"
                         class="tab-pane active" id="producto_1">
                        <?php
                        $form = ['url' => 'producto/store1',
                            'method'   => 'POST',
                            'enctype'  => 'multipart/form-data',
                            'button'   => 'Siguiente',
                            'defaults' => [
                                'producto'    => '',
                                'codigo'    => '',
                                'descripcion' => '',
                                'id_categoria'=> ''
                            ],];
                        ?>
                        @include('productos.detail1')
                    </div>
                <div role="tabpanel"
                     class="tab-pane" id="producto_2">
                    <h4 class="modal-title">
                        <?php
                        $form = ['url' => URL::route('producto.store'),
                            'method'   => 'POST',
                            'enctype'  => 'multipart/form-data',
                            'button'   => 'Siguiente',
                            'defaults' => [
                            ],];
                        ?>
                        @include('productos.detail2')
                    </h4>
                </div>
                <div role="tabpanel"
                     class="tab-pane" id="producto_3">
                    <h4 class="modal-title">
                        <?php
                        $form = ['url' => URL::route('producto.store'),
                            'method'   => 'POST',
                            'enctype'  => 'multipart/form-data',
                            'button'   => 'Siguiente',
                            'defaults' => [
                                'id_stock' => '',
                                'precio' => '',
                                'oferta' => ''
                            ],];
                        ?>
                        @include('productos.detail3')
                    </h4>
                </div>
                <div role="tabpanel"
                     class="tab-pane" id="producto_4">
                    <h4 class="modal-title">
                        <?php
                        $form = ['url' => URL::route('producto.store'),
                            'method'   => 'POST',
                            'enctype'  => 'multipart/form-data',
                            'button'   => 'Siguiente',
                            'defaults' => [
                            ],];
                        ?>
                        @include('productos.detail4')
                    </h4>
                </div>
                <div role="tabpanel"
                     class="tab-pane" id="producto_5">
                    <h4 class="modal-title">
                        <?php
                        $form = ['url' => URL::route('producto.store'),
                            'method'   => 'POST',
                            'enctype'  => 'multipart/form-data',
                            'button'   => 'Siguiente',
                            'defaults' => [
                            ],];
                        ?>
                        @include('productos.detail5')
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-sm close_modal" data-dismiss="modal">Cerrar</button>
</div>
<div class="row">
    <div class="col-xs-8">
        <p class="lead">
        </p>
    </div>
    <div class="col-xs-4">
        <div class="pull-right">
            <br>
            <a class="btn btn-primary" href="">Agregar Recompensa</a>
        </div>
    </div>
</div>
<hr>
<div class="well">
    <table class="table">
        <thead>
        <th>RECOMPENSA</th>
        <th>PUNTOS</th>
        <th>DESRIPCIÓN</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        {{--@foreach ($cliente as $cli)--}}
        <tr>
            <td>[NOMBRE RECOMPENSA]</td>
            <td>[PUNTOS]</td>
            <td>[DESCRIPCION]</td>
            <td>
                <a class="btn btn-info" href=""><i class="fa fa-pencil-square-o"></i></a>
                <a class="btn btn-danger" href="" data-toggle="modal" data-target=""><i class="fa fa-times"></i></a>&nbsp
            </td>
        </tr>
        {{--@endforeach--}}
        </tbody>
    </table>
</div>
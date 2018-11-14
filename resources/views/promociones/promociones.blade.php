<hr>
<div class="well">
    <table class="table">
        <thead>
        <th>PROMOCIÓN</th>
        <th>PRODUCTOS RELACIONADOS</th>
        <th>PRECIO</th>
        <th>FECHA INICIO</th>
        <th>FECHA FIN</th>
        <th>STOCK MAXIMO</th>
        <th>VENTAS</th>
        <th>INGRESOS</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        {{--@foreach ($cliente as $cli)--}}
        <tr>
            <td>2x1</td>
            <td>[imagen]</td>
            <td>29,192.00</td>
            <td>[fecha inicio]</td>
            <td>[fecha fin]</td>
            <td>[stock maximo]</td>
            <td>[ventas]</td>
            <td>[ingresos]</td>
            <td>
                <a class="btn btn-info" href=""><i class="fa fa-pencil-square-o"></i></a>
                <a class="btn btn-danger" href="" data-toggle="modal" data-target=""><i class="fa fa-times"></i></a>&nbsp
            </td>
        </tr>
        {{--@endforeach--}}
        </tbody>
    </table>
</div>
<hr>
<div class="well">
    <table class="table">
        <thead>
        <th>CUPÓN</th>
        <th>CONDICIONAL</th>
        <th>DESCUENTO</th>
        <th>VENCIMIENTO</th>
        <th>STOCK</th>
        <th>RECLAMADOS</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        {{--@foreach ($cliente as $cli)--}}
        <tr>
            <td>ADRELK1234</td>
            <td>[NOMBRE CUPON]</td>
            <td>50.00</td>
            <td>[vencimiento]</td>
            <td>[stock]</td>
            <td>[nro. reclamados]</td>
            <td>
                <a class="btn btn-info" href=""><i class="fa fa-pencil-square-o"></i></a>
                <a class="btn btn-danger" href="" data-toggle="modal" data-target=""><i class="fa fa-times"></i></a>&nbsp
            </td>
        </tr>
        {{--@endforeach--}}
        </tbody>
    </table>
</div>
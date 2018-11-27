<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

    <div class="form-group{!! ($errors->has('promocion')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Nombre Promoción</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="promocion" id="promocion" value="{!! Request::old('title', $form['defaults']['promocion']) !!}" type="text" class="form-control" placeholder="Nombre promocion">
            {!! ($errors->has('promocion') ? $errors->first('promocion') : '') !!}
        </div>
    </div>
    <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Imágenes</label>
    <div class="input-group control-group increment image-field" >
        <input type="file" name="filename[]" class="form-control" >
        <div class="input-group-btn">
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
        </div>
    </div>
    <div class="clone hide">
        <div class="control-group input-group image-field margin-cloned" style="margin-top:10px">
            <input type="file" name="filename[]" class="form-control">
            <div class="input-group-btn">
                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
        </div>
    </div>
    <br>
    <div class="form-group{!! ($errors->has('producto')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Producto</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="producto" id="producto" value="{!! Request::old('title', $form['defaults']['producto']) !!}" type="text" class="form-control" placeholder="Producto">
            {!! ($errors->has('producto') ? $errors->first('producto') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('precio')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Precio</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="precio" id="precio" value="{!! Request::old('title', $form['defaults']['precio']) !!}" type="text" class="form-control" placeholder="Precio">
            {!! ($errors->has('precio') ? $errors->first('precio') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('stock_maximo')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Stock Máximo</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="stock_maximo" id="stock_maximo" value="{!! Request::old('title', $form['defaults']['stock_maximo']) !!}" type="text" class="form-control" placeholder="Stock Máximo">
            {!! ($errors->has('stock_maximo') ? $errors->first('stock_maximo') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('fecha_inicio')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="fecha_inicio">Fecha Lanzamiento</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <div class="input-group date" id="datetimepicker1">
                <input name="fecha_inicio" value="{!! Request::old('fecha_inicio', $form['defaults']['fecha_inicio']) !!}" type='text' class="form-control" placeholder="Fecha Lanzamiento">
                <span class="input-group-addon"><span class="fa fa-calendar fa-fw"></span></span>
            </div>
        </div>
        {!! ($errors->has('fecha_inicio') ? $errors->first('fecha_inicio') : '') !!}
    </div>
    <div class="form-group{!! ($errors->has('fecha_fin')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="fecha_fin">Fecha Fin</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <div class="input-group date" id="datetimepicker1">
                <input name="fecha_fin" value="{!! Request::old('fecha_fin', $form['defaults']['fecha_fin']) !!}" type='text' class="form-control" placeholder="Fecha Fin">
                <span class="input-group-addon"><span class="fa fa-calendar fa-fw"></span></span>
            </div>
        </div>
        {!! ($errors->has('fecha_fin') ? $errors->first('fecha_fin') : '') !!}
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
</form>
<script type="text/javascript">

    $(document).ready(function() {

        $(".btn-success").click(function(){
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click",".btn-danger",function(){
            $(this).parents(".control-group").remove();
        });
    });

</script>
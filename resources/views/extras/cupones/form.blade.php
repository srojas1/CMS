<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

    <div class="form-group{!! ($errors->has('cupon')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Nombre Cupón</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="cupon" id="cupon" value="{!! Request::old('title', $form['defaults']['cupon']) !!}" type="text" class="form-control" placeholder="Nombre Cupon">
            {!! ($errors->has('cupon') ? $errors->first('cupon') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('descuento')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Descuento</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="descuento" id="descuento" value="{!! Request::old('title', $form['defaults']['descuento']) !!}" type="text" class="form-control" placeholder="Descuento">
            {!! ($errors->has('descuento') ? $errors->first('descuento') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('vencimiento')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="vencimiento">Vencimiento</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <div class="input-group date" id="datetimepicker1">
                <input name="vencimiento" value="{!! Request::old('vencimiento', $form['defaults']['vencimiento']) !!}" type='text' class="form-control" placeholder="Vencimiento">
                <span class="input-group-addon"><span class="fa fa-calendar fa-fw"></span></span>
            </div>
        </div>
        {!! ($errors->has('vencimiento') ? $errors->first('vencimiento') : '') !!}
    </div>
    <div class="form-group{!! ($errors->has('stock_maximo')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Stock Máximo</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="stock_maximo" id="stock_maximo" value="{!! Request::old('title', $form['defaults']['stock_maximo']) !!}" type="text" class="form-control" placeholder="Stock Máximo">
            {!! ($errors->has('stock_maximo') ? $errors->first('stock_maximo') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('condicion')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Condición</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="condicion" id="condicion" value="{!! Request::old('title', $form['defaults']['condicion']) !!}" type="text" class="form-control" placeholder="Condición">
            {!! ($errors->has('condicion') ? $errors->first('condicion') : '') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
</form>
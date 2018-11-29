<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

    <div class="form-group{!! ($errors->has('recompensa')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Nombre Recompensa</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="recompensa" id="recompensa" value="{!! Request::old('title', $form['defaults']['recompensa']) !!}" type="text" class="form-control" placeholder="Nombre Recompensa">
            {!! ($errors->has('recompensa') ? $errors->first('recompensa') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('puntos')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">puntos</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="puntos" id="puntos" value="{!! Request::old('title', $form['defaults']['puntos']) !!}" type="text" class="form-control" placeholder="Puntos">
            {!! ($errors->has('puntos') ? $errors->first('puntos') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('descripcion')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">descripcion</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="descripcion" id="descripcion" value="{!! Request::old('title', $form['defaults']['descripcion']) !!}" type="text" class="form-control" placeholder="Descripcion">
            {!! ($errors->has('descripcion') ? $errors->first('descripcion') : '') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
</form>
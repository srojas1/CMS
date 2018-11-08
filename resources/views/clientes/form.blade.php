<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">


    <div class="form-group{!! ($errors->has('nombres')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Nombres</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="nombres" id="nombres" value="{!! Request::old('title', $form['defaults']['nombres']) !!}" type="text" class="form-control" placeholder="Nombres">
            {!! ($errors->has('nombres') ? $errors->first('nombres') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('apaterno')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Apellido Paterno</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="apaterno" id="apaterno" value="{!! Request::old('title', $form['defaults']['apaterno']) !!}" type="text" class="form-control" placeholder="Apellido Paterno">
            {!! ($errors->has('apaterno') ? $errors->first('apaterno') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('amaterno')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Apellido Materno</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="amaterno" id="amaterno" value="{!! Request::old('title', $form['defaults']['amaterno']) !!}" type="text" class="form-control" placeholder="Apellido Materno">
            {!! ($errors->has('amaterno') ? $errors->first('amaterno') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('movil')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Movil</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="movil" id="movil" value="{!! Request::old('title', $form['defaults']['movil']) !!}" type="text" class="form-control" placeholder="Movil">
            {!! ($errors->has('movil') ? $errors->first('movil') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('email')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Correo</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="email" id="email" value="{!! Request::old('title', $form['defaults']['email']) !!}" type="text" class="form-control" placeholder="Correo">
            {!! ($errors->has('email') ? $errors->first('email') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('fecha_nacimiento')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Fecha Nacimiento</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="fecha_nacimiento" id="fecha_nacimiento" value="{!! Request::old('title', $form['defaults']['fecha_nacimiento']) !!}" type="text" class="form-control" placeholder="Fecha Nacimiento">
            {!! ($errors->has('fecha_nacimiento') ? $errors->first('fecha_nacimiento') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('documento')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Documento</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="documento" id="documento" value="{!! Request::old('title', $form['defaults']['documento']) !!}" type="text" class="form-control" placeholder="Documento">
            {!! ($errors->has('documento') ? $errors->first('documento') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('ranking')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Ranking</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <label name="ranking" id="ranking"/> {!! Request::old('title', $form['defaults']['ranking']) !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('puntos')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Puntos</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <label name="puntos" id="puntos"/> {!! Request::old('title', $form['defaults']['puntos']) !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('last_login')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Último Acceso</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <label name="last_login" id="last_login"/> {!! Request::old('title', $form['defaults']['last_login']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
</form>
<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}" enctype="{{ $form['enctype'] }}">

    {{ csrf_field() }}

    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

    <div class="form-group{!! ($errors->has('producto')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Nombre producto</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="producto" id="producto" value="{!! Request::old('title', $form['defaults']['producto']) !!}" type="text" class="form-control" placeholder="Nombre producto">
            {!! ($errors->has('producto') ? $errors->first('producto') : '') !!}
        </div>
    </div>
<div class="form-group{!! ($errors->has('codigo')) ? ' has-error' : '' !!}">
    <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Codigo</label>
    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
        <input name="codigo" id="codigo" value="{!! Request::old('title', $form['defaults']['codigo']) !!}" type="text" class="form-control" placeholder="Codigo">
        {!! ($errors->has('codigo') ? $errors->first('codigo') : '') !!}
    </div>
</div>
<div class="form-group{!! ($errors->has('descripcion')) ? ' has-error' : '' !!}">
    <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Descripción</label>
    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
    <input name="descripcion" id="descripcion" class="form-control"
           value="{!! Request::old('title', $form['defaults']['descripcion']) !!}">
        {!! ($errors->has('descripcion') ? $errors->first('descripcion') : '') !!}
    </div>
</div>
<div class="form-group{!! ($errors->has('id_categoria')) ? ' has-error' : '' !!}">
    <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Categoría</label>
    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
        <select class="form-control m-bot15" name="id_categoria">
            @if($categoria->count() > 0)
                @foreach($categoria as $key => $cats)
                    @if ($cats->id == $form['defaults']['id_categoria'])
                        <option value={{$cats->id}} selected>{{$cats->categoria}}</option>
                    @else
                        <option value="{{$cats->id}}">{{$cats->categoria}}</option>
                    @endif
                @endforeach
            @else
                No se encontraron resultados
            @endif
        </select>
    </div>
</div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
</form>
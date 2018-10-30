<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

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
            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion" rows="2">
                {!! Request::old('title', $form['defaults']['descripcion']) !!}
            </textarea>
        </div>
    </div>
    <div class="form-group{!! ($errors->has('id_categoria')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Categoría</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            {{--<select name="categoria" id="stock" value="a" type="text" class="form-control" placeholder="Categoria">--}}
            {{--</select>--}}
            <select class="form-control m-bot15" name="categoria">
                @if($categorias->count() > 0)
                    @foreach($categorias as $cats)
                        <option value={{$cats->id}}>{{$cats->categoria}}</option>
                    @endforeach
                @else
                    No se encontraron resultados
                @endif
            </select>
        </div>
    </div>
    <div class="form-group{!! ($errors->has('stock')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Inventario</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="stock" id="stock" value="{!! Request::old('title', $form['defaults']['stock']) !!}" type="text" class="form-control" placeholder="Stock">
            {!! ($errors->has('stock') ? $errors->first('stock') : '') !!}
        </div>
    </div>
    <div class="form-group{!! ($errors->has('precio')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Precio de lista</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="precio" id="precio" value="{!! Request::old('title', $form['defaults']['precio']) !!}" type="text" class="form-control" placeholder="Precio">
            {!! ($errors->has('precio') ? $errors->first('precio') : '') !!}
        </div>
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Oferta</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="oferta" id="oferta" value="{!! Request::old('title', $form['defaults']['oferta']) !!}" type="text" class="form-control" placeholder="Oferta">
            {!! ($errors->has('oferta') ? $errors->first('oferta') : '') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
</form>
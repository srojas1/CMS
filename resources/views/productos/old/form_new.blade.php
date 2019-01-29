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
                @if($categorias->count() > 0)
                    @foreach($categorias as $key => $cats)
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
    <div class="form-group{!! ($errors->has('id_stock')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Inventario</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            @foreach($stock as $st)
                @if ($st['value'] == $form['defaults']['id_stock'])
                    <input type="radio" name='id_stock' value={{$st['value']}} checked> {{$st['nombre']}}
                @else
                    <input type="radio" name='id_stock' value={{$st['value']}}> {{$st['nombre']}}
                @endif
            @endforeach
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
    <hr class="hr_div">
    <div>Atributos</div>
    @foreach($atributos as $nkey=>$atr)
        <div class="form-group">
            <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">{{$atr->atributo}}</label>
            <div class="input-group control-group attribute-field" >
                <input id="valor" name="valor[{{$atr->id}}]" value="" type="text" class="form-control" placeholder="Valor">
                <div class="input-group-btn">
                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                </div>
            </div>
        </div>
        <hidden name="id_atributo" value={{$atr->id}}></hidden>
    @endforeach
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function() {

            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").prev().remove();
                $(this).parents(".control-group").remove();
            });
        });
    </script>
</form>
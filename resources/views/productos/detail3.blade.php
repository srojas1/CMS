
<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}" enctype="{{ $form['enctype'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

    <div class="form-group{!! ($errors->has('id_stock')) ? ' has-error' : '' !!}">
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
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
</form>
<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">


    <div class="form-group{!! ($errors->has('atributo')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Nombre atributo</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="atributo" id="atributo" value="{!! Request::old('title', $form['defaults']['atributo']) !!}" type="text" class="form-control" placeholder="Nombre atributo">
            {!! ($errors->has('atributo') ? $errors->first('atributo') : '') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>

</form>
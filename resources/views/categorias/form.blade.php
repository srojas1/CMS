<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

    <div class="form-group{!! ($errors->has('categoria')) ? ' has-error' : '' !!}">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">Nombre categoria</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="categoria" id="categoria" value="{!! Request::old('title', $form['defaults']['categoria']) !!}" type="text" class="form-control" placeholder="Nombre categoria">
            {!! ($errors->has('categoria') ? $errors->first('categoria') : '') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>

</form>
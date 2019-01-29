<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}" enctype="{{ $form['enctype'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

<div>Vinculación</div>
<div class="form-group">
    <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
        <button class="btn btn-primary" type="submit"><i class="fa"></i> {!! $form['button'] !!}</button>
    </div>
</div>
</form>
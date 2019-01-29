
<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}" enctype="{{ $form['enctype'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

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
    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
</form>
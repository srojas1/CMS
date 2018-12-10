<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}" enctype="{{ $form['enctype'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ isset($form['_method'])? $form['_method'] : $form['method'] }}">

@foreach($atributos as $nkey=>$atr)
    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="first_name">{{$atr->atributo}}</label>
        <div class="input-group control-group attribute-field" >
            <input id="valor" name="valor[]" value="" type="text" class="form-control" placeholder="Valor">
            <div class="input-group-btn">
                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
        </div>
    </div>
    <hidden name="id_atributo" value={{$atr->id}}></hidden>
@endforeach
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
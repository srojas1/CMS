<!--- PANEL LATERAL IZQUIERDA --->
<div class="panel-modulos col-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
    <div class="modulos">
        <ul class="nav flex-column">
            @foreach($main as $item)
                <li class="nav-item">
                    <a class="nav-link" href="{!! $item['url'] !!}"><i class="material-icons">  {!! ((!$item['icon'] == '') ? $item['icon'] : '') !!}</i> {{ $item['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
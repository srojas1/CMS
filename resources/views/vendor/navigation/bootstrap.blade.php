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
{{--<div id="bar-nav">--}}
{{--<ul class="nav navbar-nav navbar-right">--}}
{{--@if ($bar)--}}
{{--<li class="dropdown">--}}
{{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--{!! $side !!} <b class="caret"></b>--}}
{{--</a>--}}
{{--<ul class="dropdown-menu">--}}
{{--@foreach($bar as $item)--}}
{{--<li>--}}
{{--<a href="{!! $item['url'] !!}">--}}
{{--{!! ((!$item['icon'] == '') ? '<i class="fa fa-'.$item['icon'].' fa-fw"></i> ' : '') !!}{{ $item['title'] }}--}}
{{--</a>--}}
{{--</li>--}}
{{--@endforeach--}}
{{--<li class="divider"></li>--}}
{{--<li>--}}
{{--<a href="{!! URL::route('account.logout') !!}">--}}
{{--<i class="fa fa-power-off fa-fw"></i> Salir--}}
{{--</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--@else--}}
{{--<li {!! (Request::is('account/login') ? 'class="active"' : '') !!}>--}}
{{--<a href="{!! URL::route('account.login') !!}">--}}
{{--Entrar--}}
{{--</a>--}}
{{--</li>--}}
{{--@if (Config::get('credentials.regallowed'))--}}
{{--<li {!! (Request::is('account/register') ? 'class="active"' : '') !!}>--}}
{{--<a href="{!! URL::route('account.register') !!}">--}}
{{--Registrarse--}}
{{--</a>--}}
{{--</li>--}}
{{--@endif--}}
{{--@endif--}}
{{--</ul>--}}
{{--<ul class="nav navbar-nav navbar-right">--}}
{{--<li class="dropdown">--}}
{{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--Notificaciones--}}
{{--<b class="caret"></b>--}}
{{--</a>--}}
{{--<ul class="dropdown-menu">--}}
{{--todo-samuel: add foreach for history--}}
{{--<li>--}}
{{--<a href="{!! $item['url'] !!}">--}}
{{--<strong>David Lee</strong> acaba de hacer un pedido--}}
{{--<strong>David Lee</strong> acaba de hacer un pedido--}}
{{--<strong>David Lee</strong> acaba de hacer un pedido--}}
{{--</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <a class="navbar-brand" href="{!! $main[0]['url'] !!}">{{ $title }}</a>
    <div class="collapse navbar-collapse">
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto">
                @foreach($main as $item)
                    <li class="nav-item" {!! ($item['active'] ? ' class="active"' : '') !!}>
                        <a href="{!! $item['url'] !!}">
                            {!! ((!$item['icon'] == '') ? '<i class="fa fa-'.$item['icon'].' fa-inverse fa-fw"></i> ' : '') !!}{{ $item['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

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

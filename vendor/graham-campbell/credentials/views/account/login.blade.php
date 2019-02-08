@include('partials.header_login')
<body class="page page-login">
<form class="form-horizontal" action="{{ URL::route('account.login.post') }}" method="POST">
    {{ csrf_field() }}
    <div class="container">
        <div class="login-box card row align-items-center col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="card-header col-12 row justify-content-center">
                <div class="col-12 row justify-content-center"><h2>INICIAR SESIÓN</h2></div>
                <div class="col-12 row justify-content-center"><span class="lead">Ingresa tu usuario y contraseña</span></div>
            </div>
            <div class="card-body col-12 row justify-content-center">

                <div class="form-group col-12 row justify-content-center {!! ($errors->has('email')) ? ' has-error' : '' !!}">
                    <input name="email" id="email" type="text" class="form-control" value="{!! Request::old('email') !!}" id="" placeholder="Usuario o correo">
                    {!! ($errors->has('email') ? $errors->first('email') : '') !!}
                </div>
                <div class="form-group col-12 row justify-content-center {!! ($errors->has('password')) ? ' has-error' : '' !!}">
                    <input name="password" id="password" type="password" class="form-control" id="" placeholder="Password">
                    {!! ($errors->has('password') ? $errors->first('password') : '') !!}
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberMe" value="1">
                    <label class="form-check-label" for="exampleCheck1">Recordar</label>
                </div>
                <div class="form-group col-12 row justify-content-center">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
                <div class="form-group col-12 row justify-content-center">
                    @if (Config::get('credentials.activation'))
                        <label><a href="{!! URL::route('account.reset') !!}" class="btn btn-link">¿Olvidaste tu contraseña?</a></label>
                    @else
                        <label><a href="{!! URL::route('account.reset') !!}" class="btn btn-link">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>
            </div>
            <div class="card-footer col-12 row justify-content-center"><span class="creditos">Todos los derechos reservados.</span></div>
        </div>
    </div>
</form>
</body>
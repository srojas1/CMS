@include('partials.header_login')
<body class="page page-login">
<form class="form-horizontal" action="{{ URL::route('account.reset.post') }}" method="POST">
    {{ csrf_field() }}
    <div class="container">
        <div class="login-box card row align-items-center col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="card-header col-12 row justify-content-center">
                <div class="col-12 row justify-content-center"><h2>RECUPERAR CONTRASEÑA</h2></div>
                <div class="col-12 row justify-content-center"><span class="lead">Ingresa tu correo.</span></div>
            </div>
            <div class="card-body col-12 row justify-content-center">
                <div class="form-group{!! ($errors->has('email')) ? ' has-error' : '' !!} col-12 row justify-content-center">
                    <input name="email" id="email" value="{!! Request::old('email') !!}" type="email" class="form-control" id="" placeholder="Correo electrónico">
                    {!! ($errors->has('email') ? $errors->first('email') : '') !!}
                </div>
                <div class="form-group col-12 row justify-content-center">
                    <button type="submit" class="btn btn-primary">Enviar correo</button>
                </div>
            </div>
            <div class="card-footer col-12 row justify-content-center"><span class="creditos">Todos los derechos reservados.</span></div>
        </div>
    </div>
</form>
</body>
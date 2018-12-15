@extends('layouts.default')

@section('title')
    Dashboard
@stop

@section('content')
    <div class="modulo container-fluid">
        <!--- CABECERA DE MÓDULO --->
        <div class="modulo-head row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7"><h2>Dashboard</h2></div>
            </div>
        </div>
        <div>
            <iframe src="https://colorlib.com/polygon/adminator/index.html" width="1000" height="400">
        </div>
    </div>
    <!--- FOOTER DE CMS --->
    <div class="footer">
        <div class="container-fluid">
            <span>@Copyright</span>
        </div>
    </div>
@stop

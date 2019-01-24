@extends('layouts.default')

@section('title')
    Configuración de empresa
@stop

@section('content')
@auth('dashboard')
    <div class="modulo container-fluid">
        <!--- CABECERA DE MÓDULO --->
        <div class="modulo-head row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7"><h2>Configuración de empresa</h2></div>
        </div>
    </div>

    <div class="board-body">
        <div class="container-fluid">
            <form id="edit_empresa_form_{!! $empresa->id !!}" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <input name="nombreEmpresa" value="{{$empresa->nombre_empresa}}" type="text" class="form-control" id="nombreEmpresa" placeholder="Empresa">
                </div>
                <div class="d-flex align-items-center row ml-1">
                    Imagen principal
                    <span class="help pl-3">
                        <a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega una imagen de 120px x 120px">
                            <i class="material-icons">help</i>
                        </a>
                    </span>
                </div>
                <div class="imagen-medidas row col-12">
                    <small>.jpg .png | 350px x 140px</small>
                </div>
                <div class="d-flex pt-4">
                    <div class="agregar-imagen-featured form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="filename_main" class="main_image custom-file-input justify-content-center" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                <label class="custom-file-label justify-content-center" for="inputGroupFile04">
                                    <i class="material-icons">add_photo_alternate</i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group">
                        <div class="inline-block position-relative">
                            <img src="{{ asset('images/'.getJsonValue($empresa->logo)) }}" class="imagen-featured shadow-sm border-top border-bottom border-right border-left">
                            <a href="#" class="badge badge-light badge-pill eliminarImagen shadow-sm">
                                <i class="material-icons">clear</i>
                            </a>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_empresa" class="id_empresa" value="{{$empresa->id}}"/>
            </form>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary btn_actualizar_empresa"><i class="fa fa-rocket"></i> Actualizar Empresa</button>
        </div>
    </div>

    <!--- FOOTER DE CMS --->
    <div class="footer">
        <div class="container-fluid">
            <span>@Copyright</span>
        </div>
    </div>
@endauth
@stop
@section('js')
    <script type="text/javascript" src="{{ asset('assets/scripts/conf-empresa.js')}}"></script>
@endsection
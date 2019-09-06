@extends('layouts.dashboard')
@section('title_dashboard')
<h1 class="h3 mb-0 text-gray-800">Publicaciones</h1>
@endsection
@section('content')
<div class="d-sm-flex align-items-left justify-content-between mb-4">
    <div class="mb-0"></div>
    <button class="btn btn-outline-success btn-circle btn-lg shadow" id="btn-agregar">
        <i class="fas fa-plus"></i>
    </button>
</div>
<!-- DataTales-->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registros</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive p-2">
            <table id="table" class="table table-striped ">
                <thead>
                    <tr>
                        <td>Imágen</td>
                        <td>Título</td>
                        <td>Contenido</td>
                        <td>Etiqueta</td>
                        <td>Idioma</td>
                        <td>Estado</td>
                        <td>Enlace 1</td>
                        <td>Enlace 2</td>
                        <td>Código QR</td>
                        <td>Editar</td>
                        <td>Eliminar</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Modals-->
<!-- Modal Datos -->
<div class="modal fade" id="modal_datos" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-data" id="form-data" novalidate>
                <div class="modal-body">
                        <div class="modal-body">
                            <div class="md-form mb-3">
                                <label><b>Título:</b></label>
                                <input type="text" class="form-control rounded" onkeyup="Mayus(this);" id="title" name="title" placeholder="Título"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>   
                            <div class="md-form mb-3">
                                <label><b>Contenido:</b></label>
                                <textarea  type="text" class="form-control rounded" rows="4" id="content_" name="content" placeholder="Contenido"></textarea>  
                            </div> 
                            <div class="md-form mb-3">
                                <label><b>Enlace 1:</b></label>
                                <input type="text" class="form-control rounded" id="link" name="link" placeholder="Enlace 1">
                            </div> 
                            <div class="md-form mb-3">
                                <label><b>Enlace 2:</b></label>
                                <input type="text" class="form-control rounded" id="link2" name="link2" placeholder="Enlace 2">
                            </div> 
                            <div class="md-form mb-3">
                                <label><b>Imagen:</b></label>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img src="" id="image" alt="image" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="custom-file">
                                            <input type="file" class="form-control custom-file-input" id="photo" name="photo" lang="es" accept=".png,.jpg,.gif" required>
                                            <label id="label_image" class="custom-file-label rounded">Elegir archivo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-form mb-3" id="select_tag"></div>
                            <div class="md-form mb-3" id="select_language"></div>  
                            <div class="md-form mb-3">
                                    <label for="state"><b>Estado:</b></label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_activo" name="state" class="custom-control-input bg-danger"
                                        value="ACTIVO" checked>
                                    <label class="custom-control-label" for="estado_activo">Activo</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_inactivo" name="state" class="custom-control-input"
                                        value="INACTIVO">
                                    <label class="custom-control-label" for="estado_inactivo">Inactivo</label>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                    <button class="btn btn-success rounded" type="submit">Aceptar<i class="icon-ok"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h2 class="text-danger">¿Está seguro que desea eliminar el registro?</h2>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger rounded" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                <button class="btn btn-success rounded" id="btn_delete">Aceptar<i class="icon-ok"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- Modal QR -->
<div class="modal fade" id="modal_qr" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title">Código QR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center table-responsive">
                <div id="qrcode"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger rounded" data-dismiss="modal">CERRAR<i class="icon-cancel"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ URL::asset('js/scripts/posts.js') }}"></script>
<script>
title_modal_data="Publicaciones";
</script>
@endsection
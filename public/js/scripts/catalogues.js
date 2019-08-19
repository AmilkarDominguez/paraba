var table;
var id = 0;
var type_catalog_id = 1;
$(document).ready(function () {
    ListDatatable();
    catch_parameters();
});
// datatable catalogos
function ListDatatable() {
    table = $('#table').DataTable({
        dom: 'lfBrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'catalogs_datatable',
            data: function (obj) {
                obj.type_catalog_id = type_catalog_id;
            }
        },
        columns: [{
                data: 'name'
            },
            {
                data: 'state',
                "render": function (data, type, row) {
                    if (row.state === 'ACTIVO') {
                        return '<center><p class="text-success"><b>ACTIVO</b></p></center>';
                    } else if (row.state === 'INACTIVO') {
                        return '<center><p class="text-warning"><b>INACTIVO</b></p></center>';
                    } else if (row.state === 'ELIMINADO') {
                        return '<center><p class="text-danger"><b>ELIMINADO</b></p></center>';
                    }
                }
            },
            {
                data: 'description'
            },
            {
                data: 'Editar',
                orderable: false,
                searchable: false
            },
            {
                data: 'Eliminar',
                orderable: false,
                searchable: false
            },
        ],
        buttons: [{
                text: '<i class="fas fa-eye"></i> ',
                className: 'btn btn-dark rounded m-2',
                titleAttr: 'Columnas',
                extend: 'colvis'
            },
            {
                text: '<i class="fas fa-file-excel"></i>',
                className: 'btn btn-dark rounded m-2',
                titleAttr: 'Excel',
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                text: '<i class="fas fa-file-pdf"></i> ',
                className: 'btn btn-dark rounded m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                text: '<i class="fas fa-print"></i> ',
                className: 'btn btn-dark rounded m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                messageTop: '  <i class="fas fa-print"></i> Esto es una prueba variable: ',
                exportOptions: {
                    columns: [0, 2]
                }
            },
            //btn Refresh
            {
                text: '<i class="fas fa-sync-alt"></i>',
                className: 'btn btn-info rounded m-2',
                action: function () {
                    table.ajax.reload();
                }
            }
        ],
    });
};

// guarda los datos nuevos
function Save() {
    $.ajax({
        url: "catalogs",
        method: 'post',
        data: catch_parameters(),
        success: function (result) {
            if (result.success) {
                VanillaToasts.create({text: result.msg,type: 'success',timeout: 5000});
                Push.create(result.msg);

            } else {
                VanillaToasts.create({text: result.msg,type: 'warning',timeout: 5000});
                Push.create(result.msg);
            }
        },
        error: function (result) {
            VanillaToasts.create({text: result.responseJSON.message,type: 'error',timeout: 5000});
            Push.create(result.responseJSON.message);
            console.log(result);
        },
    });
    table.ajax.reload();
}

// captura los datos
function Edit(id) {
    $.ajax({
        url: "catalogs/{catalog}/edit",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            show_data(result);
        },
        error: function (result) {
            VanillaToasts.create({text: result.responseJSON.message,type: 'error',timeout: 5000});
            Push.create(result.responseJSON.message);
            console.log(result);
        },

    });
};

/// muestra la vista con los datos capturados
var data_old;

function show_data(obj) {
    ClearInputs();
    obj = JSON.parse(obj);
    id = obj.id;
    $("#name").val(obj.name);
    $("#description").val(obj.description);
    $("#type_catalog_id").val(obj.type_catalog_id);
    if (obj.state == "ACTIVO") {
        $('#estado_activo').prop('checked', true);
    }
    if (obj.state == "INACTIVO") {
        $('#estado_inactivo').prop('checked', true);
    }
    $("#title-modal").html("Editar Registro");

    data_old = $(".form-data").serialize();

    $('#modal_datos').modal('show');
};

// actualiza los datos
function Update() {
    var data_new = $(".form-data").serialize();
    if (data_old != data_new) {
        $.ajax({
            url: "catalogs/{catalog}",
            method: 'put',
            data: catch_parameters(),
            success: function (result) {
                if (result.success) {
                    VanillaToasts.create({text: result.msg,type: 'success',timeout: 5000});
                    Push.create(result.msg);

                } else {
                    VanillaToasts.create({text: result.msg,type: 'warning',timeout: 5000});
                    Push.create(result.msg);
                }
            },
            error: function (result) {
                VanillaToasts.create({text: 'CONTACTE AL ADMINISTRADOR.',type: 'error',timeout: 5000});
                Push.create(result.responseJSON.message);
                console.log(result);
            },
        });
        table.ajax.reload();

    }
}

//funcion para eliminar valor seleccionado
function Delete(id_) {
    id = id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "catalogs/{catalog}",
        method: 'delete',
        data: {
            id: id
        },
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg, {
                    "closeButton": true
                });
            } else {
                VanillaToasts.create({text: result.msg,type: 'warning',timeout: 5000});
                Push.create(result.msg);
            }
        },
        error: function (result) {
            VanillaToasts.create({text: result.responseText,type: 'error',timeout: 5000});
            Push.create(result.responseJSON.message);
            console.log(result);
        },

    });
    table.ajax.reload();
    $('#modal_eliminar').modal('hide');
});

//////////////////////////////////////////////

// METODOS NECESARIOS
// funcion para volver mayusculas
function Mayus(e) {
    e.value = e.value.toUpperCase();
}

// obtiene los datos del formulario
function catch_parameters() {
    var data = $(".form-data").serialize();
    data += "&id=" + id;
    data += "&type_catalog_id=" + type_catalog_id;
    return data;
}

// muestra el modal
$("#btn-agregar").click(function () {
    ClearInputs();
    $("#title-modal").html(title_modal_data);
    $("#modal_datos").modal("show");
});

// metodo de bootstrap para validar campos

(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('form-data');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                    if (id == 0) {
                        Save();
                    } else {
                        Update();
                    }
                    $('#modal_datos').modal('hide');
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

/// limpi campos despues de utilizar el modal
function ClearInputs() {
    var forms = document.getElementsByClassName('form-data');
    Array.prototype.filter.call(forms, function (form) {
        form.classList.remove('was-validated');
    });
    //__Clean values of inputs
    $("#form-data")[0].reset();
    id = 0;
};

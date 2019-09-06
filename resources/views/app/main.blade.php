@extends('layouts.mobile')
@section('title')
PARABA
@endsection
@section('content')



<div class="row">
    <div align='center' class="col s12">
        <h5 class="teal-text text-darken-4">Bienvenido</h5>
    </div>
    <div class="col s12" id="avisos"></div>
</div>



@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //ListarAvisos();
});
function ListarAvisos() {
    $.ajax({
        url: "/api/list_advertisement",
        method: 'get',
        success: function (result) {
            var code = '';
            $.each(result, function (key, value) {
                code += '<div class="card">';
                code += '<div class="card-image">';
                code += '<img src="'+value.logo+'">';
                code += '</div>';
                code += '<div class="card-content">';
                code += '<p class="flow-text orange-text text-darken-4">'+value.nombre+'</p>';
                code += '<p>'+value.descripcion+'</p>';
                code += '<p><b>Auspiciado por: </b>'+value.auspice.nombre+'</p>';
                code += '</div>';
                code += '<div class="card-action">';
                code += '<a href="googlechrome://'+value.link+'" target="_blank"  class="flow-text orange-text text-darken-4">ver más.</a>';
                code += '</div>';
                code += '</div>';
            });

            $("#avisos").html(code);
        },
        error: function (result) {
            console.log(result);
        },

    });
}
</script>
@endsection

<!--<p><a href='twitter://user?screen_name=gajotres', target='_system'>Twitter</a></p>-->
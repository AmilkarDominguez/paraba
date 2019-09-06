@extends('layouts.mobile')
@section('title')
Transportes
@endsection
@section('content')

<div class="row">
    <div align='center' class="col s12">
        <h5 class="teal-text text-darken-4">Transportes</h5>
    </div>
    <div class="col s12" id="cards"></div>
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
    Listar();
});
function Listar() {
    $.ajax({
        url: "/api/list_transports",
        method: 'get',
        success: function (result) {
            console.log(result);
            var code = '';
            $.each(result, function (key, value) {
                code += '<div class="card">';
                code += '<div class="card-image">';
                code += '<img src="'+value.photo+'">';
                code += '</div>';
                code += '<div class="card-content">';
                code += '<p class="flow-text teal-text text-darken-4">'+value.name+'</p>';
                code += '<p>'+value.description+'</p>';
                code += '</div>';
                code += '<div class="card-action">';
                code += '<a href="'+value.link+'" target="_blank"  class="flow-text teal-text text-darken-4"><i class="fas fa-route"></i></a>';
                code += '<a href="'+value.link2+'" target="_blank"  class="flow-text teal-text text-darken-4"><i class="fas fa-link"></i></a>';
                code += '</div>';
                code += '</div>';
            });

            $("#cards").html(code);
        },
        error: function (result) {
            console.log(result);
        },

    });
}
</script>
@endsection

<!--<p><a href='twitter://user?screen_name=gajotres', target='_system'>Twitter</a></p>-->
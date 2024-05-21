@include('common.modalHead2')
<div class="row">
    <div class="col-sm-12 col-md-8">
             <!--imagen-->
        <div class="form-group custom-file">
            <img
            {{-- src="{{route($carpeta.'.getImagen', ['id' => \App\Helpers\Gambito::hash($id)])}}" --}}
        >
        </div>
    </div>
</div>
@include('common.modalFooter')
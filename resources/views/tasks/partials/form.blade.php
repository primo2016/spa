<div class="row">
    <div class="col-lg-12">
        <form id="imageUploadForm" action="javascript:void(0)" enctype="multipart/form-data">

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripción" required>
            </div>

            <div class="form-group">
                <input type="file" name="photo_name" id="photo_name">
            </div>
            <!-- <img id="thumbImg" src="" class="z-depth-1-half thumb-pic" -->
            <input type="hidden" id="task_id" name="task_id" value="0">
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" onclick="limpiar();" class="btn btn-primary">Nuevo</button>
        </form>

    </div>
</div>


@section('scriptsform')
<script type="text/javascript">

    function limpiar() {
            document.getElementById("task_id").value = 0;;
            document.getElementById("descripcion").value  = "";
            document.getElementById("photo_name").value = "";
        }

    $(document).ready(function(e) {



        $('#imageUploadForm').on('submit', (function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ url('upload/image')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    location.reload();
                },
                error: function(reject) {
                    if( reject.status === 422 ) {
                        var errors = reject.responseJSON.errors;
                        alert(errors.photo_name);
                        console.log(errors.photo_name);
                    }
                }
            });
        }));
    });
</script>
@endsection

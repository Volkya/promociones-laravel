@extends("layouts.main")

@section("header")

@endsection


@section("formagic")

<h1 class="text-center text-uppercase">Promociones importaciones y exportaciones</h1>

                <span id="aviso"></span>
                @csrf
                <form method="post" id="import-excel-form" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="import-excel">Importar archivo excel:</label>
                    <input type="file" class="form-control" name="import_excel">
                </div>                
                <div class="form-group">
                    <input type="submit" id="import" class="btn btn-primary">
                </div>

                </form>

                <script>
    $(document).ready(function(){
        $('#import-excel-form').on('submit', function(event){
            event.preventDefault();
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            $.ajax({
                // url:"./controller/import.php",
                url: "{{ url('/import') }}",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    $('#import').attr('disabled', 'disabled');
                    $('#import').val('Importando...');
                },
                success:function(data)
                {
                    $('#aviso').html(data);
                    $('#import-excel-form')[0].reset();
                    $('#import').attr('disabled', false);
                    $('#import').val('Import');
                }
            })
        });
    });
</script>
@endsection



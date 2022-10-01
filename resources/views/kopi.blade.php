<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.0/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-UkVD+zxJKGsZP3s/JuRzapi4dQrDDuEf/kHphzg8P3v8wuQ6m9RLjTkPGeFcglQU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.4.33/dist/sweetalert2.min.css'>
    <title>Distributor Kopi</title>
</head>

<body>
    {{-- Tampilan --}}
    <div class="container">
        <br>
        <H1>
            Distributor Kopi
        </H1>
        <br>
        <a class="btn btn-success" href="javascript:void(0)" id="btn-tambah-kopi"> Tambah Kopi</a>
        <br><br>
        <table class="table table-striped table-bordered data-table" id="table-kopi">
            <thead class="table-dark">
                <tr>
                    <th class="align-middle text-center">No.</th>
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Jenis Kopi</th>
                    <th class="align-middle text-center">Jumlah (kg)</th>
                    <th class="align-middle text-center">Asal</th>
                    <th class="align-middle text-center">Owner</th>
                    <th class="align-middle text-center">Action</th>
                </tr>
            </thead>
            <tr>
                {{-- <th>{{ $loop->iteration + $kopis->firstItem() - 1 }}</th> --}}
            </tr>
            <tbody>
            </tbody>
        </table>
    </div>

    {{-- Form Tambah --}}
    <div class="modal fade" id="modal-create" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="KopiForm" name="KopiForm" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Jenis Kopi</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="jenis_kopi" placeholder="Jenis Kopi"
                                    value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Jumlah</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="jumlah" placeholder="Jumlah" value=""
                                    maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Asal</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="asal" placeholder="Asal" value=""
                                    maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Owner</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control" name="id_user">
                                    <option value="">- pilih -</option>
                                    @foreach ($owners as $item)
                                    <option value="{{$item->$id_user}}">{{ $item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- form update --}}
    <div class="modal fade" id="modal-update" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="post_id">
                    <form id="KopiForm" name="KopiForm" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Jenis Kopi</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="jenis_kopi_update" value="" maxlength="50"
                                    required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Jumlah</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="jumlah_update" value="" maxlength="50"
                                    required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Asal</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="asal_update" value="" maxlength="50"
                                    required="">
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save-update" value="create">Save
                                changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.0/dist/js/coreui.bundle.min.js"
        integrity="sha384-n0qOYeB4ohUPebL1M9qb/hfYkTp4lvnZM6U6phkRofqsMzK29IdkBJPegsyfj/r4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.33/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Input DataTable
            var table = $('#table-kopi').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/kopi/list/yajra') }}",
                columns: [
                    {data: null,"sortable": false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {data: 'id', name: 'id'},
                    {data: 'jenis_kopi', name: 'jenis_kopi'},
                    {data: 'jumlah', name: 'jumlah'},
                    {data: 'asal', name: 'asal'},
                    {data: 'kopi_owner.nama', name: 'kopi_owner.nama'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            //Action Tambah 
            $('body').on('click', '#btn-tambah-kopi',function(){
                $('#modal-create').modal('show');
            });
            $('#btn-save').click(function(e){
                e.preventDefault();
                var jenis_kopi = $('#jenis_kopi').val();
                var jumlah = $('#jumlah').val();
                var asal = $('#asal').val();
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: "{{ url('/kopi/list/tambah') }}",
                    type: "POST",
                    cache:false,
                    datatype:"json",
                    data: {
                        "jenis_kopi": jenis_kopi,
                        "jumlah": jumlah,
                        "asal": asal,
                        "_token":token,
                    },
                    success:function(response){
                        //show success message
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        table.draw();
                        
                        $('#modal-create').modal('hide');
                    }
                });
            });
            
            //Action Update
            $('body').on('click', '#btn-update', function(){
                let post_id = $(this).attr('data-id');
                console.log("ini respon" + post_id);
                $.ajax({
                    url: `{{URL('kopi/list/id/${post_id}')}}`,
                    type: "GET",
                    cache: false,
                    success:function(response){
                        $('#post_id').val(response.data.id);
                        $('#jenis_kopi_update').val(response.data.jenis_kopi);
                        $('#jumlah_update').val(response.data.jumlah);
                        $('#asal_update').val(response.data.asal);
                        $('#modal-update').modal('show');
                    }
                });
            });
            $('#btn-save-update').click(function(e){
                e.preventDefault();

                //definisi variable
                var post_id = $('#post_id').val();
                var jenis_kopi = $('#jenis_kopi_update').val();
                var jumlah = $('#jumlah_update').val();
                var asal = $('#asal_update').val();

                $.ajax({
                    url: `{{URL('kopi/list/update/${post_id}')}}`,
                    type: "PUT",
                    cache:false,
                    data: {
                        "jenis_kopi": jenis_kopi,
                        "jumlah": jumlah,
                        "asal": asal,
                    },
                    success:function(response){
                        console.log(response);
                        //show success message
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        
                        table.draw();
                        
                        $('#modal-update').modal('hide');
                    }
                });
            });

            //Action Delete
            $('body').on('click', '#btn-delete', function(){
                let post_id = $(this).attr('data-id');
                Swal.fire({
                    title: "Are you sure About That?",
                    text : "Delete this data?",
                    icon : "warning",
                    cancelButtonText: "cancel",
                    showCancelButton: true,
                    confirmButtonText: "continue"
                }).then((result)=> {
                    if (result.isConfirmed){
                        console.log(result);
                        $.ajax({
                            type:'DELETE',
                            url: `{{URL('kopi/list/delete/${post_id}')}}`,
                            cache:false,
                            success:function(response){
                                Swal.fire({
                                    type:'success',
                                    icon:'success',
                                    title:`${response.message}`,
                                    showConfirmButton:false,
                                    timer:3000
                                });
                                table.draw();
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
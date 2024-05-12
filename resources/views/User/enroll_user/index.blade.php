@extends('layouts.app')
@section('enroll_user','active')
@section('showdroprn','show')
@section('showopenrn','nav-item-open')
@section('judulmenu','Enrollment New User')
@section('content')

<style>
    td, td .badge, td .bg-hover{
        font-size: 13px !important; 
    }
    .dataTables_wrapper .dataTables_processing {
    background: #FFFFCC;
    border: 1px solid black;
    border-radius: 10px;
    font-weight: bold;
    left: 63%;
    top: 125px;
    z-index: 1000;
    position: absolute;
    }
    #canhover:hover{
        transition: ease-in-out 0.15s;
        transform: scale(1.07);
        box-shadow: 2px 7px 9px -3px rgba(0,0,0,0.35);
-webkit-box-shadow: 2px 7px 9px -3px rgba(0,0,0,0.35);
-moz-box-shadow: 2px 7px 9px -3px rgba(0,0,0,0.35);
    }
    .stared a{
        color: rgb(255, 196, 0) !important;
        text-decoration: none !important;
    }

    .disabled-element {
        pointer-events: none; 
        cursor: not-allowed;
    }

    .enabled-element{
        pointer-events: auto; 
        cursor: auto;
    }
</style>

<div class="card">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="card-header d-flex justify-content-between">
        <span class="h5">
            @yield('judulmenu')
        </span>
        <div class="d-flex">
            <button id="btn_create" class="btn btn-outline-success fw-bold"><i class="ph-plus me-1"></i>Add</button>
        </div>
    </div>
    <div class="card-body">
        <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-basic table-condensed datatable-button-init-custom" width="100%" id="enroll_table">
                        <thead>
                            <tr class="bg-primary-300">
                                <th> No </th>
                                <th> NIP / NISN </th>
                                <th> Nama </th>
                                <th> Kelas </th>
                                <th> Posisi </th>
                                <th> Birthday </th>
                                <th> Status </th>
                                <th> Sidik Jari </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Start Modal --}}
@include('user.enroll_user._modal_enroll')
{{-- End Modal --}}
@endsection

@section('js')
{{-- Rapikan Dropdown inner Datatable --}}
<script type="text/javascript">
    $('.table-responsive').on('show.bs.dropdown', function () {
         $('.table-responsive').css( "overflow-y", "inherit" );
    });
    
    $('.table-responsive').on('hide.bs.dropdown', function () {
         $('.table-responsive').css( "overflow", "auto" );
    })
</script>

{{-- Datatable --}}
<script type="text/javascript">
    
    $(document).ready(function () {
        $('#enroll_table').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 25,
        scroller:true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        oLanguage: {sProcessing: `
                <img src='{{ url('assetImg/loader.gif') }}' height='50px'>
                <span class='text-nowrap text-warning'>Processing...</span>`},
        deferRender:true,
        buttons: ['pageLength',
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            'colvis'
        ],
        // scrollX:true,
        ajax: {
            type: 'GET',
            url: '{{ route('getDataEnroll')}}',
            data: function (d) {
                return $.extend({},d,{
                    
                });
            }
        },
        columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false },
        {data: 'credential_number',name: 'credential_number',searchable:true,visible:true,orderable:true},
        {data: 'nama',name: 'nama',searchable:true,visible:true,orderable:true},
        {data: 'kelas',name: 'kelas',searchable:true,visible:true,orderable:false},
        {data: 'posisi',name: 'posisi',searchable:true,visible:true,orderable:false},
        {data: 'birthday',name: 'birthday',searchable:true,visible:true,orderable:false},
        {data: 'status',name: 'status',searchable:true,visible:true,orderable:false},
        {data: 'sidik_jari',name: 'sidik_jari',searchable:true,visible:true,orderable:false},
        ]
    });
    
    var dtable = $('#enroll_table').dataTable().api();
    });
    
    $('#btnFiterSubmitSearch').click(function(){
         $('#enroll_table').DataTable().draw(true);
    }); 

    $("#btn_create").click(function () {
        $('#modal_choice_user').modal('show');
    });

</script>
@endsection

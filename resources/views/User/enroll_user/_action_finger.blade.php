@if (is_null($added))
    <a href='#' onclick="add_finger('{{ $tambah }}')" class='btn btn-warning btn-sm m-1'>+ Add</a>
@else
    <a href='#' class='badge bg-success text-success bg-opacity-20'>Added</a>
@endif
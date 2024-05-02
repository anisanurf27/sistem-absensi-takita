<?php

namespace App\Http\Controllers\Requestor;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\DataPerizinan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class InputIzinController extends Controller
{
    public function input_izin()
    {
        return view('user.input_izin.index');
    }

    public function getDataIzin(Request $request)
    {
        if ($request->ajax())
        {
            $iz = DataPerizinan::orderBy('waktu','asc')->where('deleted_at',null);
            $data = $iz->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_izin',function ($data){
                    $kode_izin = substr($data->kode_izin, 0, 1);
                    return $kode_izin;
                });
        }
    }

}

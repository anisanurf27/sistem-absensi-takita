<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AllData;
use Spatie\Permission\Models\Role;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request)
    {
        // dd($request);
        $request->validate([
            'credential_number' => 'required|string',
            'password' => 'required|string',
        ],[
            'credential_number.required' => 'NISN/NIP is required',
            'password.required' => 'Password is required',
        ]);

        $user = User::where('credential_number',$request->credential_number)->first();
        // $newData = DB::table('all_data')->where('credential_number',$request->credential_number)->where('birthdate',$request->password)->first();
        $newData = AllData::where('credential_number', $request->credential_number)
                            ->where('birthdate', $request->password)
                            ->first();

        if ($user == null) {
            if ($newData != null) {
                if ($newData->status == 'tidak aktif') {
                    return redirect()->back()
                            ->withInput($request->only('credential_number','remember'))
                            ->withErrors([
                                'account' => 'Maaf akun anda tidak aktif. Silahkan hubungi administrator sistem',
                            ]);
                } else {
                    switch ($newData->class) {
                        case 'X MIPA 1':
                            $kelas_id = 1;
                            break;

                        case 'X MIPA 2':
                            $kelas_id = 2;
                            break;

                        case 'X MIPA 3':
                            $kelas_id = 3;
                            break;    

                        case 'X MIPA 4':
                            $kelas_id = 4;
                            break;
                        
                        case 'X IPS 1':
                            $kelas_id = 5;
                            break;
                        
                        case 'X IPS 2':
                            $kelas_id = 6;
                            break;

                        default:
                            $kelas_id = 0;
                            break;
                    }

                    if ($newData) {
                        $position = strtolower($newData->position);
                    
                        if ($position == 'siswa') {
                            $role = Role::where('name', 'siswa')->where('guard_name', '')->first();
                            if ($role) {
                                $newData->assignRole($role);
                            } 
                        } elseif ($position == 'guru') {
                            $role = Role::where('name', 'guru')->where('guard_name', '')->first();
                            if ($role) {
                                $newData->assignRole($role);
                            } 
                        } elseif ($position == 'admin') {
                            $role = Role::where('name', 'admin')->where('guard_name', '')->first();
                            if ($role) {
                                $newData->assignRole($role);
                            } 
                        } else {
                            $role_id = 1;
                        }
                    } 

                    $storeUser = User::insert([
                        'credential_number' => $request->credential_number,
                        'password' => Hash::make($request->password),
                        'name' => strtoupper($newData->name),
                        'kelas_id' => $kelas_id,
                        'position' => $position,
                        'created_at'=> carbon::now(),
                        'updated_at'=> carbon::now(),
                    ]);

                    $dataUser = User::where('credential_number',$newData->credential_number)->first();

                    if (auth()->attempt(['credential_number' => $request->credential_number, 'password' => $request->password]))
                    {
                        if(auth()->user()->deleted_at!==null || $newData->status=="tidak aktif"){
                            Auth::logout();
                            return redirect()->back()
                                ->withInput($request->only('credential_number', 'remember'))
                                ->withErrors([
                                    'account' => 'Akun anda tidak aktif. Silahkan hubungi administrator sistem',
                                ]);
                        }
                        return redirect()->route('home');
                    }else{
                        Auth::logout();
                        return redirect()->back()
                            ->withInput($request->only('credential_number', 'remember'))
                            ->withErrors([
                                'account' => 'Password Salah, cek kembali . . .',
                            ]);
                    }
                }
                
            } else {
                return redirect()->back()
                    ->withInput($request->only('credential_number', 'remember'))
                    ->withErrors([
                        'account' => 'Pastikan NISN/NIP Dan Password Sudah Benar',
                ]);
            }
            
        } else {
            if (isset($user->credential_number)) {
                if (auth()->attempt(['credential_number' => $request->credential_number, 'password' => $request->password])) 
                {
                    return redirect()->route('home');
                } else {
                        Auth::logout();
                        return redirect()->back()
                            ->withInput($request->only('credential_number', 'remember'))
                            ->withErrors([
                                'account' => 'Password Salah, cek kembali . . .',
                        ]);
                }
            } else {
                Auth::logout();
                return redirect()->back()
                    ->withInput($request->only('credential_number', 'remember'))
                    ->withErrors([
                        'account' => 'Akun tidak ditemukan, cek NISN/NIP anda kembali',
                ]);
            }
            
           
           
        }
        
    }
}

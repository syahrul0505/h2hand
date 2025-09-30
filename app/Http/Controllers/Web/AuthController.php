<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Club;
use App\Models\SportClass;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $clubs = Club::orderBy('name_club', 'asc')->get();
        $classes = SportClass::orderBy('name', 'asc')->get();
        $posters = Poster::latest()->get();

        return view('web.auth.sign-up', [
            'clubs' => $clubs,
            'classes' => $classes,
            'posters' => $posters,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'fullname' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'digits:16', 'unique:users,nik'],
            'phone_number' => ['required', 'string', 'max:15'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'address' => ['required', 'string', 'max:500'],
            'school_name' => ['required', 'string', 'max:255'],
            'club_id' => ['required', 'exists:clubs,id'],
            'class_id' => ['required', 'exists:Class,id'],
        ]);

        try {
            $genderForDb = $request->gender == 'Laki-laki' ? 'male' : 'female';

            $user = User::create([
                'fullname' => Str::upper($request->fullname),
                'username' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nik' => $request->nik,
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $genderForDb,
                'address' => Str::upper($request->address),
                'school_name' => Str::upper($request->school_name),
                'club_id' => $request->club_id,
                'class_id' => $request->class_id,
            ]);

            $userRole = Role::findByName('User', 'web');
            if ($userRole) {
                $user->assignRole($userRole);
            }

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('failed', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
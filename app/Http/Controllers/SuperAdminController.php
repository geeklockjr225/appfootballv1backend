<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use App\Models\Admin;
use App\Models\User;
use App\Models\Clubs;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{

    public function registration() {
        return view('superadmin.register');
    }

    public function registration_post(Request $request) {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:super_admins',
            'phone' => 'required|string|max:10|unique:super_admins',
            'password' => 'required|min:8|confirmed',
            'terms' => 'accepted',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|string|max:255',
            'sexe'=>'required|string|max:255'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $data = $validator->validated();
    
        $user = new SuperAdmin();
        $user->full_name = trim($data['full_name']);
        $user->email = trim($data['email']);
        $user->phone = trim($data['phone']);
        $user->password = Hash::make($data['password']);
        $user->role = trim($data['role']);
        $user->sexe = trim($data['sexe']);
        $user->remember_token = Str::random(50);
    
        if ($request->hasFile('avatar')) {
            $file     = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('avatars'), $filename);
            $user->avatar = 'avatars/' . $filename;
        } else {
            $user->avatar = 'avatars/default.jpg';
        }
    
        $user->save();
    
        // Token avec Sanctum (si activé)
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return redirect()->route('superadmin.login')
        ->with('success', 'Compte créé, vous pouvez maintenant vous connecter.');
    }

    public function login() {
        return view('superadmin.login');
    }
     
    public function login_post(Request $request)
    {



        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('username', 'password');
        $user = SuperAdmin::where('email', $credentials['username'])
                    ->orWhere('phone', $credentials['username'])
                    ->first();
    
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->with('error', 'Identifiants invalides');
        }
    
        //Auth::login($user);
        Auth::guard('superadmin')->login($user);
        return redirect()->route('superadmin.dashboard');
    

        
    }


    public function logout() {
        Auth::logout();
        return redirect(url('superadmin/login'));
    }


    public function dashboard()
{
    // Récupération de l'utilisateur connecté via le guard "superadmin"
    $superAdmin = Auth::guard('superadmin')->user();

    // Retourner une vue avec les infos du super admin
    return view('superadmin.dashboard', compact('superAdmin'));
}


public function createclubs() {
    return view('superadmin.create-clubs');

}

public function createclubs_post(Request $request) {


     // 1) Validation
     $data = $request->validate([
        // — Données du club
        'name'           => ['required','string','max:255'],
        'address'        => ['required','string','max:500'],
        'email'          => ['required','email','max:255','unique:clubs,email'],
        'phone'          => ['required','string','max:20'],
        'logo'           => ['required','image','max:2048'],
        'description'    => ['nullable','string'],

        // — Données du président
        'avatar'               => ['required','image','max:2048'],
        'role'                 => ['required','in:admin'],                // role pour users
        'sexe'                 => ['required','in:Homme,Femme'],     // pour admins
        'full_name'            => ['required','string','max:255'],   // pour admins
        'admin_email'      => ['required','email','max:255',
                                    'unique:users,email'],          // unique dans users
        'admin_phone'      => ['required','string','max:20'],    // pour admins
        'password'             => ['required','confirmed',
                                    Password::defaults()],            // users
        'terms'                => ['accepted'],                     // pour admins
    ]);

    // 2) Transaction
    DB::transaction(function() use ($data) {
        // Upload du logo et création du club
        $logoPath = $data['logo']->store('clubs/logos', 'public');
        $club = Clubs::create([
            'name'        => $data['name'],
            'address'     => $data['address'],
            'email'       => $data['email'],
            'phone'       => $data['phone'],
            'logo_path'   => $logoPath,
            'description' => $data['description'] ?? null,
        ]);

        // Création de l’utilisateur (User) pour le président
        $user = User::create([
            'email'    => $data['admin_email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);

        // Upload de l’avatar et création de l’Admin
        $avatarPath = $data['avatar']->store('admins/avatars', 'public');
        Admin::create([
            'user_id'         => $user->id,
            'club_id'         => $club->id,
            'full_name'            => $data['full_name'],
            'admin_phone'           => $data['admin_phone'],
            'sexe'            => $data['sexe'],
            'avatar'          => $avatarPath,
            'terms_accepted'  => true,
        ]);
    });

    // 3) Redirection
    return redirect()
        ->route('superadmin.dashboard') // Assurez-vous que cette route existe
        ->with('success', 'Club et président créés avec succès.');


    
}





}

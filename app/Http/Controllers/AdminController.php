<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User; 
use App\Models\Coatch; 
use Illuminate\Support\Facades\Hash; 
use App\Models\AssistantAdmin; 
use App\Models\Joeur; // Add this line to import the Joueur model
use App\Models\Parents;


class AdminController extends Controller
{

    public function registerCoach(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'            => 'required|string|max:255',
            'email'                => 'required|string|email|max:255|unique:coatches,email',
            'phone'                => 'required|string|max:20|unique:coatches,phone',
            'password'             => 'required|string|min:6|confirmed',
            'avatar'               => 'nullable|string',    
            'terms'                => 'required|boolean',
            'role'                 => 'required|string', 
            'sexe'                 => 'required|in:Homme,Femme',
            'specialite'           => 'nullable|string|max:255',
            'annee_experience'     => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'coatch'
        ]);

        // 2) Création dans la table `coatches`
        $coach = Coatch::create([
            'full_name'        => $request->full_name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'password'         => Hash::make($request->password),
            'avatar'           => $request->avatar,
            'terms'            => $request->terms,
            'role'             => $request->role,
            'sexe'             => $request->sexe,
            'specialite'       => $request->specialite,
            'annee_experience' => $request->annee_experience,
            'user_id'          => $user->id,
        ]);

        return response()->json([
            'status' => true,
            'message'=> 'Coach créé avec succès.',
            'coach'  => $coach,
        ], 201);
    }


    public function registerAssistantAdmin(Request $request)
    {
        // 1) Validation des champs reçus
        $validator = Validator::make($request->all(), [
            'full_name'         => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:assistant_admins,email',
            'phone'             => 'required|string|max:20|unique:assistant_admins,phone',
            'password'          => 'required|string|min:6|confirmed',
            'avatar'            => 'nullable|string',       // URL ou chemin relatif, géré plus loin
            'terms'             => 'required|boolean',
            'role'              => 'required|string',      // ex : 4 pour assistant
            'sexe'              => 'required|in:Homme,Femme',
            'diplome'           => 'required|string|max:255',
            'annee_experience'  => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // 2) Création de l’utilisateur dans `users`
        $user = User::create([
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,  // role numérique ou string selon votre logique
        ]);

        // 3) Insertion dans `assistant_admins`
        $assistant = AssistantAdmin::create([
            'full_name'        => $request->full_name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'password'         => Hash::make($request->password), // on recalcule le hash pour la table spécifique
            'avatar'           => $request->avatar,
            'terms'            => $request->terms,
            'role'             => $request->role,
            'sexe'             => $request->sexe,
            'diplome'          => $request->diplome,
            'annee_experience' => $request->annee_experience,
            'user_id'          => $user->id,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Assistant Admin créé avec succès.',
            'assistant' => $assistant,
        ], 201);
    }

    public function registerParentJoueur(Request $request)
    {
        // 1) Validation de l’ensemble des champs parent + joueur
        $validator = Validator::make($request->all(), [
            // CHAMPS PARENT
            'parent_full_name'         => 'required|string|max:255',
            'parent_email'             => 'required|string|email|max:255|unique:parents,email',
            'parent_phone'             => 'required|string|max:20|unique:parents,phone',
            'parent_password'          => 'required|string|min:6',
            'parent_avatar'            => 'nullable|string',
            'parent_terms'             => 'required|string',
            'parent_role'              => 'required|string',
            'parent_sexe'              => 'required|in:Homme,Femme',

            // CHAMPS JOUEUR
            'joueur_full_name'         => 'required|string|max:255',
            'joueur_email'             => 'required|string|email|max:255|unique:joeurs,email',
            'joueur_phone'             => 'required|string|max:20|unique:joeurs,phone',
            'joueur_avatar'            => 'nullable|string',
            'joueur_terms'             => 'required|string',
            'joueur_sexe'              => 'required|in:Homme,Femme',
            'joueur_date_de_naissance' => 'required|date',
            'joueur_classe'            => 'required|string|max:100',
            'joueur_antecedent'        => 'nullable|string|max:255',
            'joueur_categorie'         => 'required|string|max:100',
            'joueur_taille'            => 'required|string|max:10',
            'joueur_poids'             => 'required|string|max:10',
            'joueur_position'          => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        dd($request->all());


       

        // 2) Création du User pour le parent
        $userParent = User::create([
            'email'    => $request->parent_email,
            'password' => Hash::make($request->parent_password),
            'role'     => $request->parent_role,
        ]);

        // 3) Insertion dans `parents`
        $parent = Parents::create([
            'full_name' => $request->parent_full_name,
            'email'     => $request->parent_email,
            'phone'     => $request->parent_phone,
            'password'  => Hash::make($request->parent_password),
            'avatar'    => $request->parent_avatar,
            'terms'     => $request->parent_terms,
            'role'      => $request->parent_role,
            'sexe'      => $request->parent_sexe,
            'user_id'   => $userParent->id,
        ]);

        // 4) Insertion dans `joeurs`, lié au parent créé
        $joueur = Joeur::create([
            'full_name'         => $request->joueur_full_name,
            'email'             => $request->joueur_email,
            'phone'             => $request->joueur_phone,
            'avatar'            => $request->joueur_avatar,
            'terms'             => $request->joueur_terms,
            'sexe'              => $request->joueur_sexe,
            'date_de_naissance' => $request->joueur_date_de_naissance,
            'classe'            => $request->joueur_classe,
            'antecedent'        => $request->joueur_antecedent,
            'categorie'         => $request->joueur_categorie,
            'taille'            => $request->joueur_taille,
            'poids'             => $request->joueur_poids,
            'position'          => $request->joueur_position,
            'parent_id'         => $parent->id,
        ]);
       

        // 5) Retour JSON de confirmation
        return response()->json([
            'status'  => true,
            'message' => 'Parent et joueur créés avec succès.',
            'parent'  => $parent,
            'joueur'  => $joueur,
        ], 201);

    
    }




    


    //
}

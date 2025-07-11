@extends('base')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Création de Club</h1>

    <form action="{{ route('superadmin.create-clubs_post') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Informations du club --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Informations du club</h2>
            
            {{-- Nom --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-600 mb-1">Nom du club</label>
                <input type="text" name="name" id="name" 
                    value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="Nom du club">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Adresse --}}
            <div class="mb-4">
                <label for="address" class="block text-gray-600 mb-1">Adresse</label>
                <input type="text" name="address" id="address" 
                    value="{{ old('address') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="Adresse du club">
                @error('address')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-600 mb-1">Email du club</label>
                <input type="email" name="email" id="email" 
                    value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="contact@club.com">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Téléphone --}}
            <div class="mb-4">
                <label for="phone" class="block text-gray-600 mb-1">Téléphone du club</label>
                <input type="text" name="phone" id="phone" 
                    value="{{ old('phone') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="+225 07 23 45 67 81">
                @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Logo --}}
            <div class="mb-4">
                <label for="logo" class="block text-gray-600 mb-1">Logo du club</label>
                <input type="file" name="logo" id="logo" accept="image/*"
                    class="w-full text-gray-700">
                @error('logo')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-gray-600 mb-1">Description du club</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500"
                    placeholder="Parlez-nous de votre club…">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Informations du président --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Informations du président</h2>

            {{-- Avatar --}}
            <div class="mb-4">
                <label for="avatar" class="block text-gray-600 mb-1">Photo du président</label>
                <input type="file" name="avatar" id="avatar" accept="image/*"
                    class="w-full text-gray-700">
                @error('avatar')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Rôle (fixe Administrateur) --}}
            <div class="mb-4">
                <label for="role" class="block text-gray-600 mb-1">Rôle</label>
                <select name="role" id="role"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500">
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Sexe --}}
            <div class="mb-4">
                <label for="sexe" class="block text-gray-600 mb-1">Sexe</label>
                <select name="sexe" id="sexe"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500">
                    <option value="Homme" {{ old('sexe') == 'Homme' ? 'selected' : '' }}>Homme</option>
                    <option value="Femme" {{ old('sexe') == 'Femme' ? 'selected' : '' }}>Femme</option>
                </select>
                @error('sexe')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>


            {{-- Nom complet --}}
            <div class="mb-4">
                <label for="full_name" class="block text-gray-600 mb-1">Nom complet</label>
                <input type="text" name="full_name" id="full_name" 
                    value="{{ old('full_name') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="Prénom Nom">
                @error('full_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="president_email" class="block text-gray-600 mb-1">Email</label>
                <input type="email" name="admin_email" id="admin_email" 
                    value="{{ old('admin_email') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="president@club.com">
                @error('admin_email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Téléphone --}}
            <div class="mb-4">
                <label for="president_phone" class="block text-gray-600 mb-1">Téléphone</label>
                <input type="text" name="admin_phone" id="admin_phone" 
                    value="{{ old('admin_phone') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="+225 07 23 45 67 81">
                @error('admin_phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Mot de passe --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-600 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="••••••••">
                @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Confirmer mot de passe --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-600 mb-1">Confirmer mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500" 
                    placeholder="••••••••">
            </div>

            {{-- Conditions --}}
            <div class="flex items-center mb-4">
                <input type="checkbox" name="terms" id="terms" value="1"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                    {{ old('terms') ? 'checked' : '' }}>
                <label for="terms" class="ml-2 text-gray-600 text-sm">J'accepte les conditions d'utilisation</label>
            </div>
            @error('terms')<p class="text-red-500 text-sm mb-4">{{ $message }}</p>@enderror
        </div>

        {{-- Bouton de soumission --}}
        <div class="text-center">
            <button type="submit"
                class="inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                {{ __('Créer le club') }}
            </button>
        </div>
    </form>
</div>
@endsection

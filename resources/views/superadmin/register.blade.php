@extends('base')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Créez votre compte Super Admin</h2>

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('superadmin.registration_post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Avatar --}}
                <div class="mb-4 text-center">
                    <label for="avatar" class="block mb-2 text-gray-700">Avatar</label>
                    <input type="file" name="avatar" id="avatar" accept="image/*" class="block w-full text-sm text-gray-700">
                    @error('avatar')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Role --}}
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 mb-2">Rôle</label>
                    <select name="role" id="role" class="block w-full border border-gray-300 rounded px-3 py-2">
                        <option value="superadmin" {{ old('role')=='superadmin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @error('role')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Sexe --}}
                <div class="mb-4">
                    <label for="sexe" class="block text-gray-700 mb-2">Sexe</label>
                    <select name="sexe" id="sexe" class="block w-full border border-gray-300 rounded px-3 py-2">
                        <option value="Homme" {{ old('sexe')=='Homme' ? 'selected' : '' }}>Homme</option>
                        <option value="Femme" {{ old('sexe')=='Femme' ? 'selected' : '' }}>Femme</option>
                    </select>
                    @error('sexe')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Nom complet --}}
                <div class="mb-4">
                    <label for="full_name" class="block text-gray-700 mb-2">Nom complet</label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" placeholder="Nom complet"
                           class="block w-full border border-gray-300 rounded px-3 py-2">
                    @error('full_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email"
                           class="block w-full border border-gray-300 rounded px-3 py-2">
                    @error('email')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Téléphone --}}
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Téléphone"
                           class="block w-full border border-gray-300 rounded px-3 py-2">
                    @error('phone')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Mot de passe --}}
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe"
                           class="block w-full border border-gray-300 rounded px-3 py-2">
                    @error('password')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Confirmer mot de passe --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 mb-2">Confirmer mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer mot de passe"
                           class="block w-full border border-gray-300 rounded px-3 py-2">
                </div>

                {{-- Conditions --}}
                <div class="mb-6 flex items-center">
                    <input type="checkbox" name="terms" id="terms" value="1" {{ old('terms') ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 text-gray-700">J'accepte les conditions d'utilisation</label>
                </div>
                @error('terms')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror

                <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700">
                    S'INSCRIRE
                </button>
            </form>

            <p class="mt-4 text-center text-gray-600">
                Déjà inscrit ? <a href="{{url('superadmin/login')}}" class="text-blue-600 font-bold">Se connecter</a>
            </p>
        </div>
    </div>
</div>
@endsection

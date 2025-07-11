@extends('base')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Se connecter</h2>

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('superadmin.login_post') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="username" id="username" value="{{ old('username') }}" placeholder="Email" 
                           class="block w-full border border-gray-300 rounded px-3 py-2">
                    @error('username')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Mot de passe --}}
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" 
                           class="block w-full border border-gray-300 rounded px-3 py-2">
                    @error('password')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Se souvenir de moi --}}
                <div class="mb-6 flex items-center">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 text-gray-700">Se souvenir de moi</label>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 cursor-auto">
                    CONNEXION
                </button>
            </form>

            <p class="mt-4 text-center text-gray-600">
                Pas encore de compte ? <a href="{{route('superadmin.registration')}}" class="text-blue-600 font-bold">Créer un compte</a>
            </p>
        </div>
    </div>
</div>
@endsection

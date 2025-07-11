@extends('base') 
@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4 sm:px-8">
    {{-- Header utilisateur --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            @if($superAdmin && $superAdmin->avatar)
                <img src="{{ $superAdmin->avatar ? asset('avatars/' . $superAdmin->avatar) : asset('avatars/default.jpg')  }}" alt="Avatar" class="w-12 h-12 rounded-full object-cover">
            @else
                <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white text-lg font-bold">
                    {{ strtoupper(substr($superAdmin->full_name, 0, 1)) }}
                </div>
            @endif
            <div>
                <p class="text-sm text-gray-500">Bienvenue,</p>
                <p class="text-lg font-semibold text-gray-800">{{ $superAdmin->full_name}}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('superadmin.logout') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')" class="inline">
            @csrf
            <button class="flex items-center space-x-1 text-red-500 hover:text-red-700 cursor-pointer">
                <x-lucide-log-out class="w-5 h-5" />
                <span>Déconnexion</span>
            </button>
        </form>
    </div>

    {{-- Carte résumé --}}
    <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Tableau de bord</h2>
        <p class="text-sm text-gray-600">Gérez facilement vos clubs et accédez à toutes les fonctionnalités</p>
    </div>

    {{-- Menu en grille --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
        {{-- Exemple de carte --}}
        <a href="{{ route('superadmin.create-clubs') }}" class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition">
            <div class="w-16 h-16 rounded-xl bg-blue-600 flex items-center justify-center mb-4">
                <x-lucide-user class="w-8 h-8 text-white" />
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Créer un Club</h3>
            <p class="text-sm text-gray-500">Gérer vos clubs</p>
        </a>
        <a href="{{ route('superadmin.login') }}" class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition">
            <div class="w-16 h-16 rounded-xl bg-green-500 flex items-center justify-center mb-4">
                <x-lucide-settings class="w-8 h-8 text-white" />
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Paramètres</h3>
            <p class="text-sm text-gray-500">Configuration</p>
        </a>
        <a href="{{ route('superadmin.login') }}" class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition">
            <div class="w-16 h-16 rounded-xl bg-orange-500 flex items-center justify-center mb-4">
                <x-lucide-bell class="w-8 h-8 text-white" />
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Notifications</h3>
            <p class="text-sm text-gray-500">3 nouvelles</p>
        </a>
        <a href="{{ route('superadmin.login') }}" class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition">
            <div class="w-16 h-16 rounded-xl bg-purple-600 flex items-center justify-center mb-4">
                <x-lucide-user class="w-8 h-8 text-white" />
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Profil</h3>
            <p class="text-sm text-gray-500">Vos informations</p>
        </a>
    </div>

    {{-- Footer --}}
    <div class="text-center text-xs text-gray-400">
        App version 1.0.0
    </div>
</div>
@endsection

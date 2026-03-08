@extends('layouts.app')
@section('content')

<a href="{{ route('clients.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-blue-600 transition-colors mb-6">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    Retour aux clients
</a>

<div class="max-w-xl">

    {{-- HEADER CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-5 flex items-center gap-5">
        <div class="w-16 h-16 rounded-full bg-blue-100 text-blue-700 font-bold text-xl flex items-center justify-center flex-shrink-0">
            {{ $client->initiales }}
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $client->nom }}</h1>
            @if($client->entreprise)
                <span class="inline-flex items-center mt-1 px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                    {{ $client->entreprise }}
                </span>
            @endif
        </div>
    </div>

    {{-- DETAILS CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 divide-y divide-gray-100 mb-5">

        <div class="flex items-center gap-4 px-6 py-4">
            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Email</p>
                <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $client->email }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 px-6 py-4">
            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Téléphone</p>
                <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $client->telephone ?? '—' }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 px-6 py-4">
            <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Entreprise</p>
                <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $client->entreprise ?? '—' }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 px-6 py-4">
            <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Ajouté le</p>
                <p class="text-sm font-semibold text-gray-800 mt-0.5">{{ $client->created_at->format('d/m/Y à H:i') }}</p>
            </div>
        </div>

    </div>

    {{-- ACTIONS --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('clients.edit', $client) }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors px-5 py-2.5 rounded-lg shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Modifier
        </a>
        <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Supprimer ce client ?')">
            @csrf @method('DELETE')
            <button type="submit"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 transition-colors px-5 py-2.5 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Supprimer
            </button>
        </form>
    </div>

</div>
@endsection

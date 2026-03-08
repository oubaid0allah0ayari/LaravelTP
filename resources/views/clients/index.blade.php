@extends('layouts.app')
@section('content')

{{-- PAGE HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Clients</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $clients->total() }} client(s) au total</p>
    </div>
    <a href="{{ route('clients.create') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors px-4 py-2.5 rounded-lg shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau client
    </a>
</div>

{{-- SEARCH BAR --}}
<form method="GET" action="{{ route('clients.index') }}" class="mb-5">
    <div class="relative max-w-sm">
        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Rechercher un client..."
               class="w-full pl-10 pr-4 py-2.5 text-sm rounded-lg border border-gray-300 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition">
    </div>
</form>

@if($clients->isEmpty())
    {{-- EMPTY STATE --}}
    <div class="bg-white rounded-2xl border border-dashed border-gray-300 py-20 text-center">
        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <p class="text-gray-500 font-medium">Aucun client trouvé</p>
        <a href="{{ route('clients.create') }}" class="mt-4 inline-block text-sm text-blue-600 hover:underline">Ajouter votre premier client →</a>
    </div>
@else
    {{-- CLIENTS TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Client</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Téléphone</th>
                    <th class="px-4 py-3">Entreprise</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @foreach($clients as $client)
                <tr class="hover:bg-gray-50 transition-colors">
                    {{-- AVATAR + NOM --}}
                    <td class="px-6 py-4">
                        <a href="{{ route('clients.show', $client) }}" class="flex items-center gap-3 group">
                            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 font-bold text-sm flex items-center justify-center flex-shrink-0">
                                {{ $client->initiales }}
                            </div>
                            <span class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                                {{ $client->nom }}
                            </span>
                        </a>
                    </td>
                    <td class="px-4 py-4 text-gray-500">{{ $client->email }}</td>
                    <td class="px-4 py-4 text-gray-500">{{ $client->telephone ?? '—' }}</td>
                    <td class="px-4 py-4">
                        @if($client->entreprise)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                {{ $client->entreprise }}
                            </span>
                        @else
                            <span class="text-gray-300">—</span>
                        @endif
                    </td>
                    {{-- ACTIONS --}}
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('clients.edit', $client) }}"
                               class="inline-flex items-center gap-1 text-xs font-medium text-gray-600 hover:text-blue-600 bg-gray-100 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Éditer
                            </a>
                            <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Supprimer ce client ?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 text-xs font-medium text-gray-600 hover:text-red-600 bg-gray-100 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($clients->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $clients->links() }}
    </div>
    @endif
@endif

@endsection

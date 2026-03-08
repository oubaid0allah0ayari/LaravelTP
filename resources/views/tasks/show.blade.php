@extends('layouts.app')
@section('content')

{{-- BACK LINK --}}
<a href="{{ route('tasks.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-blue-600 transition-colors mb-6">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    Retour aux tâches
</a>

<div class="max-w-2xl">

    {{-- HEADER CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-5">
        <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                    @if($task->is_completed)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Terminée
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>En cours
                        </span>
                    @endif
                    @php
                        $colors = ['bg-gray-100 text-gray-600','bg-blue-100 text-blue-600','bg-yellow-100 text-yellow-600','bg-orange-100 text-orange-600','bg-red-100 text-red-600','bg-red-200 text-red-700'];
                        $labels = ['Nulle','Basse','Normale','Moyenne','Haute','Critique'];
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $colors[$task->priority ?? 0] }}">
                        Priorité: {{ $labels[$task->priority ?? 0] }}
                    </span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $task->title }}</h1>
            </div>
        </div>
    </div>

    {{-- DETAILS CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 divide-y divide-gray-100 mb-5">

        {{-- Due Date --}}
        <div class="flex items-center gap-4 px-6 py-4">
            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Échéance</p>
                <p class="text-sm font-semibold text-gray-800 mt-0.5">
                    {{ optional($task->due_date)->format('d/m/Y') ?? '—' }}
                    @if($task->due_date && $task->due_date->isPast() && !$task->is_completed)
                        <span class="text-red-500 text-xs ml-1">(En retard)</span>
                    @endif
                </p>
            </div>
        </div>

        {{-- Priority --}}
        <div class="flex items-center gap-4 px-6 py-4">
            <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6H10l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Priorité</p>
                <div class="flex items-center gap-1 mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="w-5 h-2 rounded-full {{ $i <= $task->priority ? 'bg-blue-500' : 'bg-gray-200' }}"></div>
                    @endfor
                    <span class="text-xs text-gray-500 ml-1">{{ $task->priority }}/5</span>
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="px-6 py-4">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                </div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Description</p>
            </div>
            <p class="mt-3 text-sm text-gray-700 whitespace-pre-line leading-relaxed pl-12">
                {{ $task->description ?: 'Aucune description fournie.' }}
            </p>
        </div>
    </div>

    {{-- ACTIONS --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('tasks.edit', $task) }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors px-5 py-2.5 rounded-lg shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Modifier
        </a>
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Supprimer cette tâche ?')">
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
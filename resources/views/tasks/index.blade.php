@extends('layouts.app')
@section('content')

{{-- PAGE HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Mes tâches</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $tasks->total() }} tâche(s) au total</p>
    </div>
    <a href="{{ route('tasks.create') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors px-4 py-2.5 rounded-lg shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle tâche
    </a>
</div>

@if($tasks->isEmpty())
    {{-- EMPTY STATE --}}
    <div class="bg-white rounded-2xl border border-dashed border-gray-300 py-20 text-center">
        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <p class="text-gray-500 font-medium">Aucune tâche pour l'instant</p>
        <a href="{{ route('tasks.create') }}" class="mt-4 inline-block text-sm text-blue-600 hover:underline">Créer votre première tâche →</a>
    </div>
@else
    {{-- TASKS TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Titre</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Échéance</th>
                    <th class="px-4 py-3">Priorité</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @foreach($tasks as $task)
                <tr class="hover:bg-gray-50 transition-colors">
                    {{-- TITLE --}}
                    <td class="px-6 py-4">
                        <a href="{{ route('tasks.show', $task) }}"
                           class="font-semibold text-gray-900 hover:text-blue-600 transition-colors line-clamp-1">
                            {{ $task->title }}
                        </a>
                        @if($task->description)
                        <p class="text-gray-400 text-xs mt-0.5 truncate max-w-xs">{{ $task->description }}</p>
                        @endif
                    </td>

                    {{-- STATUS BADGE --}}
                    <td class="px-4 py-4">
                        @if($task->is_completed)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Terminée
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>En cours
                            </span>
                        @endif
                    </td>

                    {{-- DUE DATE --}}
                    <td class="px-4 py-4 text-gray-500">
                        @if($task->due_date)
                            <span class="{{ $task->due_date->isPast() && !$task->is_completed ? 'text-red-500 font-medium' : '' }}">
                                {{ $task->due_date->format('d/m/Y') }}
                            </span>
                        @else
                            <span class="text-gray-300">—</span>
                        @endif
                    </td>

                    {{-- PRIORITY --}}
                    <td class="px-4 py-4">
                        @php
                            $colors = ['bg-gray-200 text-gray-600','bg-blue-100 text-blue-600','bg-yellow-100 text-yellow-600','bg-orange-100 text-orange-600','bg-red-100 text-red-600','bg-red-200 text-red-700'];
                            $labels = ['Nulle','Basse','Normale','Moyenne','Haute','Critique'];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $colors[$task->priority ?? 0] }}">
                            {{ $labels[$task->priority ?? 0] }}
                        </span>
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('tasks.edit', $task) }}"
                               class="inline-flex items-center gap-1 text-xs font-medium text-gray-600 hover:text-blue-600 bg-gray-100 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Éditer
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette tâche ?')">
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
    @if($tasks->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $tasks->links() }}
    </div>
    @endif
@endif

@endsection
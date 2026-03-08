@extends('layouts.app')
@section('content')

<a href="{{ route('tasks.show', $task) }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-blue-600 transition-colors mb-6">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    Retour à la tâche
</a>

<div class="max-w-xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-1">Modifier la tâche</h1>
    <p class="text-sm text-gray-400 mb-6 truncate">{{ $task->title }}</p>

    {{-- ERRORS --}}
    @if($errors->any())
    <div class="flex gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
        <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <ul class="text-sm space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- TITLE --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Titre <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                       class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition {{ $errors->has('title') ? 'border-red-400 bg-red-50' : '' }}">
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                <textarea name="description" rows="4"
                          class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition resize-none {{ $errors->has('description') ? 'border-red-400 bg-red-50' : '' }}">{{ old('description', $task->description) }}</textarea>
            </div>

            {{-- DATE & PRIORITY --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Date d'échéance</label>
                    <input type="date" name="due_date"
                           value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}"
                           class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Priorité <span class="text-gray-400 font-normal">(0–5)</span></label>
                    <select name="priority" class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition">
                        @foreach(['Nulle','Basse','Normale','Moyenne','Haute','Critique'] as $i => $label)
                            <option value="{{ $i }}" {{ old('priority', $task->priority) == $i ? 'selected' : '' }}>{{ $i }} — {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- COMPLETED CHECKBOX --}}
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                <input type="checkbox" name="is_completed" id="is_completed" value="1"
                       {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="is_completed" class="text-sm font-medium text-gray-700 cursor-pointer">Marquer comme terminée</label>
            </div>

            {{-- SUBMIT --}}
            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors px-6 py-2.5 rounded-lg shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Mettre à jour
                </button>
                <a href="{{ route('tasks.show', $task) }}"
                   class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 transition-colors px-5 py-2.5 rounded-lg">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
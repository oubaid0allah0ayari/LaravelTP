@extends('layouts.app')
@section('content')

<a href="{{ route('clients.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-blue-600 transition-colors mb-6">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    Retour aux clients
</a>

<div class="max-w-xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Nouveau client</h1>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('clients.store') }}" class="space-y-5">
            @csrf

            {{-- Reusable input components (Step 3: Vues Avancées Blade) --}}
            <x-form-input name="nom"       label="Nom complet"      :value="old('nom')"       placeholder="Ex: Jean Dupont"               required />
            <x-form-input name="email"     label="Adresse email"    :value="old('email')"     placeholder="jean@exemple.com" type="email" required />
            <x-form-input name="telephone" label="Téléphone"        :value="old('telephone')" placeholder="+33 6 00 00 00 00" hint="Optionnel" />
            <x-form-input name="entreprise" label="Entreprise"      :value="old('entreprise')" placeholder="Nom de l'entreprise"          hint="Optionnel" />

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors px-6 py-2.5 rounded-lg shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Enregistrer
                </button>
                <a href="{{ route('clients.index') }}"
                   class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 transition-colors px-5 py-2.5 rounded-lg">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

{{-- Reusable form input component --}}
{{-- Usage: <x-form-input name="nom" label="Nom" :value="old('nom')" required /> --}}
@props([
    'name',
    'label',
    'type'  => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'hint' => null,
])

<div>
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 mb-1.5">
        {{ $label }}
        @if($required) <span class="text-red-500">*</span> @endif
    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        class="w-full rounded-lg border bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400
               focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition
               {{ $errors->has($name) ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
    >

    @error($name)
        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01"/>
            </svg>
            {{ $message }}
        </p>
    @enderror

    @if($hint && !$errors->has($name))
        <p class="mt-1 text-xs text-gray-400">{{ $hint }}</p>
    @endif
</div>

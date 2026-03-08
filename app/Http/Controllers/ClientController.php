<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // --- Validation rules (Step 1) ---
    private array $rules = [
        'nom'        => 'required|string|min:2|max:100',
        'email'      => 'required|email|max:255',
        'telephone'  => 'nullable|string|max:30',
        'entreprise' => 'nullable|string|max:150',
    ];

    private array $messages = [
        'nom.required'   => 'Le nom est obligatoire.',
        'nom.min'        => 'Le nom doit contenir au moins 2 caractères.',
        'email.required' => 'L\'adresse email est obligatoire.',
        'email.email'    => 'L\'adresse email n\'est pas valide.',
        'email.unique'   => 'Cette adresse email est déjà utilisée.',
    ];

    public function index(Request $request)
    {
        $clients = Client::query()
            ->when($request->search, fn($q) => $q->search($request->search))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $rules = array_merge($this->rules, ['email' => 'required|email|unique:clients,email|max:255']);
        $validated = $request->validate($rules, $this->messages);
        Client::create($validated);
        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès.');
    }

    public function show(int $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    public function edit(int $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, int $id)
    {
        $client = Client::findOrFail($id);
        $rules = array_merge($this->rules, ['email' => "required|email|unique:clients,email,{$id}|max:255"]);
        $validated = $request->validate($rules, $this->messages);
        $client->update($validated);
        return redirect()->route('clients.index')->with('success', 'Client mis à jour.');
    }

    public function destroy(int $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé.');
    }
}

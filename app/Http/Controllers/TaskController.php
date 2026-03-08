<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{
    /**
     * Affiche la liste des tâches.
     */
    public function index()
    {
        // Récupère les tâches récentes avec pagination
        $tasks = Task::latest()->paginate(10);

        // Retourne la vue en passant les données
        return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        return view('tasks.create');
    }
    public function store(Request $request)
    {
        // 1. Validation des données 
        $validated = $request->validate(
            [
                'title' => 'required|string|min:3|max:255',
                'description' => 'nullable|string',
                'is_completed' => 'sometimes|boolean',
                'due_date' => 'nullable|date',
                'priority' => 'nullable|integer|min:0|max:5',
            ]
        );
        // 2.Gestion de la case à cocher (booléen) 
        $validated['is_completed'] = $request->has('is_completed');
        // 3. Création de la tâche en base de données 
        Task::create($validated);
        // 4. Redirection avec message flash 
        return redirect()->route('tasks.index')->with('success', 'Tâche 	créée avec succès.');
    }
    public function show(int $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function edit(int $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // Met à jour la tâche en base de données
    public function update(Request $request, int $id)
    {
        $task = Task::findOrFail($id);
        // 1. Validation (Mêmes règles que store)
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'sometimes|boolean',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|integer|min:0|max:5',
        ]);
        // 2. Gestion explicite de la checkbox
        $validated['is_completed'] = $request->has('is_completed');
        // 3. Mise à jour de l'instance
        $task->update($validated);
        // 4. Redirection avec message flash
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tâche supprimée.');
    }
    
}
@foreach($clients as $client)
 <div class="client-card">
 <span>{{ $client->nom }}</span>

 <!-- Formulaire de suppression -->
 <form action="/clients/{{ $client->id }}"
 method="POST"
 style="display:inline">

 @csrf
 @method('DELETE')

 <button type="submit" class="btn-danger">
                Supprimer
 </button>

 </form>
 </div>
@endforeach
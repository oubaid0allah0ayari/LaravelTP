<!-- resources/views/client_form.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Nouveau Client</title>
</head>
<body>
    <h1>Ajouter un client</h1>

    <!-- Formulaire POST vers la route /clients -->
    <form action="/clients" method="POST">
        
        @csrf <!-- Protection CSRF OBLIGATOIRE -->

        <label>Nom :</label>
        <input type="text" name="nom" required>
        <br>

        <label>Email :</label>
        <input type="email" name="email" required>
        <br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
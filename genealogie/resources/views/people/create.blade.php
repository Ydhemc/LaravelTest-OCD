<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une nouvelle personne</title>
</head>
<body>
    <h1>Ajouter une nouvelle personne</h1>

    <form action="{{ route('people.store') }}" method="POST">
        @csrf
        <div>
            <label for="first_name">Prénom :</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        <div>
            <label for="last_name">Nom :</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>
        <button type="submit">Ajouter</button>
    </form>

    <a href="{{ route('people.index') }}">Retour à la liste</a>
</body>
</html>

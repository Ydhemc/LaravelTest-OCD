<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Personnes</title>
</head>
<body>
    <h1>Liste des Personnes</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('people.create') }}">Ajouter une nouvelle personne</a>

    <ul>
        @foreach($people as $person)
            <li>
                <a href="{{ route('people.show', $person->id) }}">
                    {{ $person->first_name }} {{ $person->last_name }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>

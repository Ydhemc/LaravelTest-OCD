<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de {{ $person->first_name }} {{ $person->last_name }}</title>
</head>
<body>
    <h1>Détails de {{ $person->first_name }} {{ $person->last_name }}</h1>

    <h2>Parents :</h2>
    <ul>
        @foreach($person->parents as $parent)
            <li>{{ $parent->parent->first_name }} {{ $parent->parent->last_name }}</li>
        @endforeach
    </ul>

    <h2>Enfants :</h2>
    <ul>
        @foreach($person->children as $child)
            <li>{{ $child->child->first_name }} {{ $child->child->last_name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('people.index') }}">Retour à la liste</a>
</body>
</html>

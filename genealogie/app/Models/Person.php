<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'birth_name', 'middle_names', 'date_of_birth', 'created_by'];

    public function children()
    {
        return $this->hasMany(Relationship::class, 'parent_id');
    }

    public function parents()
    {
        return $this->hasMany(Relationship::class, 'child_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getDegreeWith($target_person_id)
    {
        $visited = []; 
        $queue = []; 
        $degree = 0; 

        // Ajouter la personne actuelle à la file d'attente
        $queue[] = ['person' => $this, 'degree' => 0];
        $visited[$this->id] = true;

        while (count($queue) > 0) {
            // Extraire la première personne de la file d'attente
            $current = array_shift($queue);
            $current_person = $current['person'];
            $current_degree = $current['degree'];

            // Si la personne cible est trouvée, retourner le degré
            if ($current_person->id == $target_person_id) {
                return $current_degree;
            }

            // Si le degré est supérieur à 25, arrêter la recherche
            if ($current_degree > 25) {
                return false;
            }

            // Ajouter les parents à la file d'attente si non visités
            foreach ($current_person->parents as $parent) {
                if (!isset($visited[$parent->id])) {
                    $visited[$parent->id] = true;
                    $queue[] = ['person' => $parent, 'degree' => $current_degree + 1];
                }
            }

            // Ajouter les enfants à la file d'attente si non visités
            foreach ($current_person->children as $child) {
                if (!isset($visited[$child->id])) {
                    $visited[$child->id] = true;
                    $queue[] = ['person' => $child, 'degree' => $current_degree + 1];
                }
            }
        }

        // Si la personne cible n'est pas trouvée, retourner false
        return false;
    }
}

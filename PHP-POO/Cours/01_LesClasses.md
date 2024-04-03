# Les classes

Une classe est un modèle pour créer des objets dans la programmation orientée objet (POO). Les classes définissent les propriétés (variables) et les méthodes (fonctions) que les objets créés à partir de cette classe auront.

Voici la syntaxe de base pour définir une classe en PHP :

```php
class NomDeLaClasse {
}
```

Décomposons cette syntaxe :

1. **Mot-clé `class`** : Le mot-clé `class` est utilisé pour déclarer une nouvelle classe. Il doit être suivi du nom de la classe.
2. **Nom de la classe** : Le nom de la classe doit commencer par une lettre ou un trait de soulignement, suivi de n'importe quelle combinaison de lettres, chiffres et traits de soulignement. Les noms de classe sont sensibles à la casse et doivent suivre la convention PascalCase (chaque mot commence par une majuscule).
3. **Accolades `{}`** : Les accolades délimitent le début et la fin de la définition de la classe. Tout ce qui se trouve entre les accolades fait partie de la classe.

## Propriétés et Méthodes

1. **Propriétés** : Les propriétés sont des variables qui appartiennent à la classe. Elles peuvent être déclarées en utilisant les modificateurs d'accès `public`, `protected` ou `private`, suivis du nom de la propriété et du type de données (facultatif depuis PHP 7). Les propriétés peuvent contenir des valeurs par défaut.
2. **Méthodes** : Les méthodes sont des fonctions qui appartiennent à la classe. Elles peuvent être déclarées en utilisant les modificateurs d'accès `public`, `protected` ou `private`, suivis du mot-clé `function`, du nom de la méthode et des paramètres (facultatifs). Les méthodes peuvent également avoir un type de retour (facultatif depuis PHP 7).

Voici un exemple de classe en PHP :

```php
class Voiture {
// propriétés
    public $marque;
    public $modele;
    public $couleur;

// méthodes
    public function klaxonner() {
        print("tut tut");
    }
}
```

Dans cet exemple, nous avons une classe `Voiture` avec trois propriétés (`marque`, `modele`, `couleur`) et une méthode (`klaxonner`).

## Création d’un objet

Pour créer un objet à partir de cette classe, vous pouvez utiliser le mot-clé `new` :

```php
$maVoiture = new Voiture();
$maVoiture->klaxonner();

```

Cela créera un nouvel objet `Voiture` et appellera la méthode `klaxonner()`
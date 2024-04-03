# Vibilité des propriétés et des méthodes

En PHP, la visibilité est contrôlée par trois mots-clés: `public`, `private`, `protected`. Ces mots-clés déterminent l'accès aux propriétés et méthodes d'une class à partir d'autres classes ou instances.

1. `public` : Les propriétés et méthodes déclarées avec le mot-clé `public` sont accessibles depuis n'importe où, c'est-à-dire à l'intérieur de la classe, depuis les classes enfants et depuis les instances d'objets

```php
class Voiture {
    public $marque;

    public function afficherMarque() {
        echo "Marque: " . $this->marque;
    }
}

$maVoiture = new Voiture();
$maVoiture->marque = "Toyota";
$maVoiture->afficherMarque(); // Affiche "Marque: Toyota"
```

2. `protected`: Les propriétés et méthodes déclarées avec le mot-clé `protected` sont accessibles à l'intérieur de la classe et depuis les classes enfants, mais pas depuis les instances d'objet.

```php
class Voiture {
    protected $marque;

    protected function afficherMarque() {
        echo "Marque: ". $this->marque;
    }
}

class VoitureElectrique extends Voiture {
    public function afficherDetails() {
        $this->marque = 'Tesla';
        $this->afficherMarque(); // Affiche "Marque: Tesla"
    }
}

$maVoiture = new VoitureElectrique();
$maVoiture->afficherDetails();
```

3. `private`: Les propriétés et méthodes déclarées avec le mot-clé `private` sont accessibles uniquement à l'intérieur de la classe où elles sont définies. Elles ne sont pas accessibles depuis les classes enfants ni depuis les instances d'objets.

## Les accesseurs et mutateurs

Les accesseurs (getters) et les mutateurs(setters) sont des méthodes qui permettent de contrôler l'accès aux propriétés d'une classe depuis l'extérieur

### Les accesseurs (getters)
Un accesseur est une méthode qui permet de récupérer la valeur d'une propriété privée ou protégée. La convention de nommage pour les accesseurs est d'utiliser le préfixe `get` suivi du nom de la propriété

```php
class CompteBancaire {
    private $solde;

    public function __construct($soldeInitial) {
        $this->solde = $soldeInitial;
    }

    public function getSolde() {

        return $this->solde;
    }
}
```

### Les mutateurs(setters)
Un mutateur est une méthode qui permet de modifier la valeur d'une propriété privée ou protégée.
La convention de nommage pour les mutateurs est d'utiliser le préfixe `set` suivi du nom de la propriété.

```php
class CompteBancaire {
    private $solde;

    public function __construct($soldeInitial) {
        $this->solde = $soldeInitial;
    }

    public function setSolde($nouveauSolde) {
        if ($nouveauSolde >= 0) {
            $this->solde = $nouveauSolde;
        } else {
            throw new Exception("Le solde ne peut pas être négatif")
        }
    }
}

$compte = new compteBancaire(1000);
$compte->setSolde(500); // modifie le solde du compte à 500euros
$compte->setSolde(-100); // génère une exception car le solde ne peut pas être négatif
```
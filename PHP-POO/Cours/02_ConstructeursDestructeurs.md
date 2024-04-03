# Constructeurs et destructeurs

**Constructeurs**

Un constructeur est une méthode spéciale d'une classe qui est exécutée automatiquement lors de la création d'un nouvel objet à partir de cette classe. Le nom du constructeur doit être le même que le nom de la classe, et il ne doit pas avoir de type de retour.

Le constructeur est utilisé pour initialiser les propriétés de l'objet et effectuer d'autres tâches de configuration nécessaires lors de la création de l'objet.

Depuis les versions modernes de PHP (à partir de PHP 5), le nom du constructeur doit être `__construct()` (avant il fallait l’appeler du même nom que la classe). On peut remarquer les deux underscores, il s’agit d’une **méthode magique**. (méthode prédéfinie qui est automatiquement appelée dans certaines circonstances ou lorsque certains événements se produisent)

### $this

Le mot-clé `$this` est une variable spéciale en PHP qui fait référence à l'instance courante de la classe. Il est utilisé pour accéder aux propriétés et aux méthodes de l'objet courant à l'intérieur de la classe.

`$this` n'est pas une variable ordinaire, mais plutôt une référence à l'objet courant. Elle est automatiquement définie et disponible dans toutes les méthodes de la classe, sans avoir besoin de la déclarer ou de lui attribuer une valeur.

Voici un exemple de constructeur en PHP :

```php
class Voiture {
    public $marque;
    public $modele;
    public $couleur;

    public function __construct($marque, $modele, $couleur) {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->couleur = $couleur;
    }
}

$maVoiture = new Voiture('Toyota', 'Corolla', 'Rouge');

```

Dans cet exemple, la classe `Voiture` a un constructeur qui prend trois paramètres : `$marque`, `$modele` et `$couleur`. Lorsqu'un nouvel objet `Voiture` est créé, le constructeur est appelé avec les valeurs spécifiées, et les propriétés de l'objet sont initialisées avec ces valeurs.

**Lorsqu'un constructeur est défini dans une classe, vous devez passer par lui pour créer une nouvelle instance d'objet. Le constructeur est automatiquement appelé lors de la création d'un nouvel objet à partir de la classe, et vous devez fournir les arguments requis par le constructeur.**

**Si vous ne fournissez pas les arguments requis, PHP générera une erreur. Si vous ne voulez pas fournir d'arguments lors de la création d'un objet, vous pouvez définir des valeurs par défaut pour les paramètres du constructeur ou créer un constructeur sans paramètre.**

### **Destructeurs**

Un destructeur est une méthode spéciale d'une classe qui est exécutée automatiquement lorsqu'un objet est détruit, c'est-à-dire lorsqu'il n'y a plus de références à cet objet ou lorsque le script PHP se termine. Le nom du destructeur doit être le même que le nom de la classe, précédé d'un tilde (`~`).

Le destructeur est utilisé pour effectuer des tâches de nettoyage, telles que la libération de ressources ou la fermeture de connexions, avant que l'objet ne soit détruit.

Voici un exemple de destructeur en PHP :

```php
class Connexion {
    private $connexion;

    public function __construct() {
        $this->connexion = new PDO('mysql:host=localhost;dbname=test', 'utilisateur', 'mot_de_passe');
    }

    public function __destruct() {
        $this->connexion = null;
    }
}

$maConnexion = new Connexion();
// ...
// Lorsque le script se termine ou qu'il n'y a plus de références à $maConnexion, le destructeur est appelé et la connexion est fermée.

```

Dans cet exemple, la classe `Connexion` a un constructeur qui crée une connexion à une base de données MySQL et un destructeur qui ferme la connexion en définissant la propriété `$connexion` à `null`.

En résumé, les constructeurs et les destructeurs sont des méthodes spéciales en PHP utilisées pour initialiser et nettoyer les objets. Les constructeurs sont appelés lors de la création d'un nouvel objet, tandis que les destructeurs sont appelés lorsqu'un objet est détruit. Ils jouent un rôle important dans la gestion des ressources et la configuration des objets.

N’oubliez pas que la fonction `$unset()` permet de tuer une variable (donc une instance d’objet)
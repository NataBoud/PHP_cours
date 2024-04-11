**Exercice : Gestion d'un tournoi de tennis**

Vous devez créer une application en ligne de commande qui permet de gérer un tournoi de tennis. L'application doit permettre d'ajouter, de modifier, de supprimer et de lister des joueurs, ainsi que de créer des matchs entre ces joueurs. Les joueurs ont un nom, un prénom et un classement. Les matchs ont deux joueurs, un score et une date.

Voici les fonctionnalités à implémenter :

1. Créer une interface `JoueurInterface` qui définit les méthodes `getNom()`, `getPrenom()` et `getClassement()`.
2. Créer une classe concrète `Joueur` qui implémente l'interface `JoueurInterface`. Cette classe doit contenir les propriétés `nom`, `prenom` et `classement`, ainsi que les méthodes `getNom()`, `getPrenom()` et `getClassement()`.
3. Créer une classe concrète `Match` qui contient deux propriétés de type `JoueurInterface`, une propriété `score` et une propriété `date`. Cette classe doit également contenir une méthode `getVainqueur()` qui renvoie le joueur qui a gagné le match (c'est-à-dire celui qui a le score le plus élevé).
4. Créer une classe `Tournoi` qui contient une propriété `joueurs` (un tableau de joueurs) et une propriété `matchs` (un tableau de matchs). Cette classe doit également contenir les méthodes suivantes :
* `ajouterJoueur(JoueurInterface $joueur)` : permet d'ajouter un joueur à la liste des joueurs.
* `modifierJoueur(int $index, JoueurInterface $joueur)` : permet de modifier un joueur de la liste des joueurs.
* `supprimerJoueur(int $index)` : permet de supprimer un joueur de la liste des joueurs.
* `listerJoueurs()` : permet de lister tous les joueurs.
* `creerMatch(JoueurInterface $joueur1, JoueurInterface $joueur2, string $score, \DateTime $date)` : permet de créer un match entre deux joueurs et de l'ajouter à la liste des matchs.
* `listerMatchs()` : permet de lister tous les matchs.

Une fois le fonctionnel construit, créez un système de menu dans le terminal qui permet de choisir les différentes fonctionnalités de l'application (ajouter un joueur, modifier un joueur, etc.).



Bonus: Utiliser des namespaces pour organiser le code. Vous pouvez utiliser la classe `DateTime` de PHP pour gérer les dates des matchs.

Bonne chance !
**Contexte :**

Vous êtes chargé de développer une application pour gérer les attractions d'un parc d'attractions. Dans ce parc, il y a des manèges et des spectacles. Les manèges ont un nom et une hauteur minimale requise pour y accéder, tandis que les spectacles ont un nom et une durée. De plus, les manèges peuvent être réservés à l'avance, tandis que les spectacles peuvent être ajoutés à une liste de favoris.

**Objectif :**

1. Créez un namespace `ParcAttraction` pour regrouper toutes les classes liées au parc d'attractions.
2. Créez une interface `Reservable` avec une méthode `reserver()`.
3. Créez une interface `Favorisable` avec une méthode `ajouterAuxFavoris()`.
4. Créez une classe abstraite `Attraction` avec un nom et une méthode `getNom()`.
5. Créez une classe `Manège` qui hérite de `Attraction`, implémente l'interface `Reservable` et qui a une propriété `hauteurMinimum`.
6. Créez une classe `Spectacle` qui hérite de `Attraction`, implémente l'interface `Favorisable` et qui a une propriété `duree`.
7. Créez un trait `Tarification` qui définit une méthode `getPrix()` pour calculer le prix d'une attraction en fonction de sa popularité (propriété `popularite` à ajouter aux classes `Manège` et `Spectacle`).
8. Ajoutez le trait `Tarification` aux classes `Manège` et `Spectacle`.
9. Créez une classe `Parc` qui contient une liste d'attractions (manèges et spectacles) et qui permet d'ajouter et de récupérer des attractions.
10. Créez une instance de `Parc` et ajoutez des manèges et des spectacles à cette instance. Affichez ensuite la liste des attractions du parc.
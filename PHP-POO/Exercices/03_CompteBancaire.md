# Compte bancaire

**Exercice :** Créer une classe `CompteBancaire` avec les propriétés suivantes : `titulaire` (chaîne de caractères), `solde` (nombre à virgule flottante) et `devise` (chaîne de caractères). La classe doit avoir un constructeur qui prend en paramètres le nom du titulaire, le solde initial et la devise, et qui initialise les propriétés correspondantes. La classe doit également avoir un destructeur qui affiche un message lorsque l'objet est détruit. La classe doit également avoir les méthodes suivantes :

- `deposer($montant)` : ajoute le montant spécifié au solde du compte.
- `retirer($montant)` : retire le montant spécifié du solde du compte, à condition que le solde soit suffisant.
- `afficherSolde()` : affiche le solde du compte avec la devise.

Créez ensuite un objet `compte` à partir de la classe `CompteBancaire` en utilisant le constructeur pour initialiser ses propriétés. Déposez ensuite de l'argent sur le compte en utilisant la méthode `deposer()`, retirez de l'argent du compte en utilisant la méthode `retirer()`, et affichez le solde du compte en utilisant la méthode `afficherSolde()`. Enfin, détruisez l'objet `compte` en utilisant la fonction `unset()` pour déclencher l'appel du destructeur.
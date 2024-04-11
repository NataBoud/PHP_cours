# Les exceptions

Les exceptions sont des objets qui représentent des erreurs ou des évènements exceptionnels qui surviennent lors de l'exécution d'un programme. Elles permettent de gérer ces erreurs de manière contrôlée et structurée.

Les exceptions en PHP sont basées sur la classe `Exception`, qui est une classe de base pour tous les dérivées. Pour lever une exception, vous pouvez utiliser le mot-clé `throw` suivi d'une instance de la classe Exception ou d'une sous-classe de celle-ci.

```php
throw new Exception('Erreur: quelque chose s\'est mal passé');
```

Pour capturer une exception, vous pouvez utiliser une structure `try-catch`. Le code qui peut lever une exception est placé dans un bloc `try`, suivi d'un ou plusieurs blocs `catch` qui spécifient les types d'exception à capturer et le code à exécuter lorsqu'une exception est capturée.

```php
try {
    // code qui peut lever une exception
} catch (Exception $e) {
    // code à exécuter lorsqu'une exception (de type Exception) est capturée
    echo 'Une exception a été capturée: ', $e->getMessage(), '\n';
}
```

Vous pouvez également définir vos propres exceptions en créant des sous-classes de la classe Exception.
Vous pouvez aussi utiliser la méthode `finally` pour définir du code à exécuter quelle que soit l'issue de la structure `try-catch`. Ce code sera exécuté même si une exception n'est pas capturée.

```php
try {
    // code qui peut lever une exception
} catch (Exception $e) {
    // code à exécuter lorsqu'une exception (de type Exception) est capturée
    echo 'Une exception a été capturée: ', $e->getMessage(), '\n';
} finally {
    // code à exécuter quelle que soit l'issue de la structure try-catch
    echo 'Code exécuté dans le bloc finally';
}
```

## Exception / ErrorException

La principale différence entre `Exception` et `ErrorException` est que `Exception` est utilisée pour représenter des erreurs qui sont levées manuellement dans le code, tandis que `ErrorException` est utilisée pour représenter des erreurs qui sont levées automatiquement par PHP.

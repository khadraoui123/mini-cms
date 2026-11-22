# Session 06 - Défi : publier et dépublier

La route posts.publication apparaît dans route:list avec le verbe PATCH : oui

Le bouton affiche « Publier » sur un brouillon et « Dépublier » sur un article publié : oui

published_at est rempli à la publication et vidé à la dépublication : oui

Le nouveau test passe et php artisan test est vert : oui

Pourquoi PATCH et pas PUT ni GET pour ce bouton ?

PATCH ne modifie qu'une partie de la ressource (ici le champ `is_published` et sa date associée), alors que PUT remplacerait tous les champs du formulaire et exigerait donc titre, slug et contenu. GET ne doit jamais modifier de données : il sert uniquement à lire une ressource.

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->get()->keyBy('email');
        $categories = Category::query()->get()->keyBy('slug');
        $tags = Tag::query()->get()->keyBy('slug');

        $posts = [
            [
                'title' => "Comprendre le cycle de vie d'une requête Laravel",
                'excerpt' => "De la route au rendu Blade, suivez le chemin exact d'une requête HTTP dans une application Laravel.",
                'body' => "Une requête HTTP entre par public/index.php, puis le routeur détermine le contrôleur à appeler. Les middlewares appliquent ensuite l'authentification, la protection CSRF ou le mode lecture seule avant de laisser la logique métier s'exécuter.\n\nDans ce projet, le contrôleur prépare uniquement les données et laisse les vues Blade afficher le résultat. Cette séparation rend le code plus simple à tester : une vue ne doit jamais interroger la base toute seule.",
                'category' => 'laravel',
                'author' => 'camille@mini-cms.test',
                'tags' => ['laravel', 'php'],
            ],
            [
                'title' => 'Créer une API REST propre avec les ressources Eloquent',
                'excerpt' => 'Transformez vos modèles en réponses JSON cohérentes sans dupliquer la logique de sérialisation.',
                'body' => "Une ressource Eloquent décrit précisément les champs exposés par l'API. Elle permet de masquer les données sensibles et d'enrichir une réponse avec des relations déjà chargées.\n\nAvant d'ajouter une ressource, vérifiez toujours les relations utilisées par le contrôleur. Charger `user`, `category` et `tags` en amont évite les requêtes surprises lorsque le format JSON est construit.",
                'category' => 'laravel',
                'author' => 'karim@mini-cms.test',
                'tags' => ['api', 'laravel'],
            ],
            [
                'title' => 'Sécuriser ses formulaires contre la falsification de requête',
                'excerpt' => 'La directive @csrf, les verbes HTTP et les policies forment une défense simple mais efficace.',
                'body' => "Laravel génère un jeton CSRF par session et vérifie sa présence sur chaque requête d'écriture. La directive @csrf dans les formulaires suffit à bloquer la majorité des tentatives de soumission depuis un site tiers.\n\nLa sécurité ne s'arrête pas là : chaque action sensible passe aussi par une policy. Le contrôleur demande l'autorisation avant de modifier ou supprimer un article, et la vue masque les boutons inutiles.",
                'category' => 'laravel',
                'author' => 'admin@mini-cms.test',
                'tags' => ['securite', 'php'],
            ],
            [
                'title' => 'Tester ses routes avec Pest sans dépendre du navigateur',
                'excerpt' => "Des tests HTTP rapides suffisent à vérifier le code, le contenu et les règles d'accès de vos pages.",
                'body' => "Pest permet d'écrire des tests lisibles avec `get()`, `post()` et les assertions de réponse. Inutile de démarrer un navigateur pour vérifier qu'une page renvoie bien 200 et qu'elle contient le titre attendu.\n\nUtilisez RefreshDatabase pour repartir d'une base propre à chaque test. Les factories créent alors uniquement les enregistrements nécessaires à la situation testée.",
                'category' => 'laravel',
                'author' => 'sofia@mini-cms.test',
                'tags' => ['tests', 'laravel'],
            ],
            [
                'title' => "Optimiser les requêtes Eloquent avec l'eager loading",
                'excerpt' => 'Chargez les relations dont vous avez besoin avant la boucle pour éviter le redoutable problème N+1.',
                'body' => "Le lazy loading est pratique pendant le développement, mais il génère une requête supplémentaire à chaque itération. Sur une liste de vingt articles, cela peut transformer une page rapide en une page lente.\n\nLa méthode `with('user', 'category', 'tags')` charge toutes les relations en quelques requêtes. Activez `Model::preventLazyLoading()` en développement pour détecter les oublis dès qu'ils apparaissent.",
                'category' => 'laravel',
                'author' => 'youssef@mini-cms.test',
                'tags' => ['eloquent', 'performance'],
            ],
            [
                'title' => 'Organiser ses routes et ses contrôleurs dans un CMS',
                'excerpt' => 'Un découpage clair entre routes publiques, routes authentifiées et espace administration change tout.',
                'body' => "Regrouper les routes par middleware rend visible la frontière entre visiteur, auteur et administrateur. Le fichier de routes devient alors une cartographie lisible des permissions du projet.\n\nLes contrôleurs restent minces : ils valident la requête, appellent le modèle et renvoient une vue ou une redirection. Toute la présentation reste dans Blade.",
                'category' => 'laravel',
                'author' => 'camille@mini-cms.test',
                'tags' => ['laravel', 'php'],
            ],
            [
                'title' => 'Construire une grille responsive avec Tailwind CSS',
                'excerpt' => 'Une colonne sur mobile, deux sur tablette, trois sur desktop : quelques classes suffisent.',
                'body' => "Tailwind suit une approche mobile-first : les classes de base s'appliquent partout, puis les variantes `sm:`, `md:` et `lg:` ajoutent des comportements à partir d'un seuil donné.\n\nPour une grille d'articles, `grid gap-6 sm:grid-cols-2 lg:grid-cols-3` offre une excellente base. Ajoutez une carte avec `overflow-hidden`, un ombre douce et un léger effet au survol pour obtenir un rendu professionnel sans CSS supplémentaire.",
                'category' => 'frontend',
                'author' => 'sofia@mini-cms.test',
                'tags' => ['tailwindcss', 'javascript'],
            ],
            [
                'title' => 'Créer une navbar mobile accessible sans JavaScript',
                'excerpt' => "L'élément details et les variantes responsives de Tailwind suffisent pour un menu compact.",
                'body' => "Un menu mobile peut rester simple : l'élément natif `details` gère l'ouverture et la fermeture sans une ligne de JavaScript. Il conserve aussi un comportement compréhensible par les lecteurs d'écran.\n\nCôté style, masquez le menu de bureau avec `md:flex` et affichez le bouton hamburger avec `md:hidden`. Pensez à donner un libellé explicite au résumé pour que l'action soit comprise.",
                'category' => 'frontend',
                'author' => 'youssef@mini-cms.test',
                'tags' => ['tailwindcss', 'javascript'],
            ],
            [
                'title' => 'Ajouter des transitions au survol sans sacrifier la performance',
                'excerpt' => 'Transformations et ombres donnent du relief à une interface si elles restent discrètes.',
                'body' => "Un effet comme `hover:-translate-y-1 hover:shadow-xl` attire l'attention vers une carte cliquable. Ajoutez `transition duration-300` pour éviter le changement brutal.\n\nGardez des valeurs modérées : une animation trop ample donne une impression d'instabilité. Ajoutez aussi un état de focus visible pour les personnes qui naviguent au clavier.",
                'category' => 'frontend',
                'author' => 'karim@mini-cms.test',
                'tags' => ['tailwindcss', 'performance'],
            ],
            [
                'title' => 'Composants Blade : quand extraire une carte réutilisable',
                'excerpt' => 'Un composant avec props et attribute bag garde vos vues courtes et cohérentes.',
                'body' => "Dès qu'un bloc de balisage apparaît dans trois vues, il mérite un composant Blade. La carte d'article est le cas idéal : accueil, liste et articles liés affichent exactement la même information.\n\nDéclarez les données attendues avec `@props(['post'])`, puis laissez l'attribute bag recevoir les classes supplémentaires. Le composant devient explicite et réutilisable sans duplication.",
                'category' => 'frontend',
                'author' => 'admin@mini-cms.test',
                'tags' => ['tailwindcss', 'php'],
            ],
            [
                'title' => "Gérer l'état d'un formulaire avec JavaScript moderne",
                'excerpt' => 'Quelques écouteurs suffisent pour améliorer le retour visuel sans réécrire le serveur.',
                'body' => "La validation serveur reste la source de vérité : elle protège l'application même si JavaScript est désactivé. Le côté client peut seulement rendre l'expérience plus agréable.\n\nAfficher un compteur de caractères ou désactiver temporairement un bouton pendant l'envoi sont de bons exemples. La logique métier, elle, ne quitte jamais le contrôleur.",
                'category' => 'frontend',
                'author' => 'camille@mini-cms.test',
                'tags' => ['javascript', 'tailwindcss'],
            ],
            [
                'title' => 'Typographie et lisibilité : bien choisir ses classes Tailwind',
                'excerpt' => "Taille, interlignage et largeur de lecture font plus pour la clarté qu'une palette complexe.",
                'body' => "Un contenu long se lit mieux dans une colonne limitée à environ soixante-dix caractères. Dans Tailwind, `max-w-3xl` et `leading-relaxed` créent rapidement cette zone de lecture confortable.\n\nHiérarchisez ensuite avec `text-4xl` pour le titre, `text-lg` pour l'introduction et `text-base` pour le corps. La cohérence de ces choix compte plus que l'originalité.",
                'category' => 'frontend',
                'author' => 'sofia@mini-cms.test',
                'tags' => ['tailwindcss', 'performance'],
            ],
            [
                'title' => 'Modéliser une relation many-to-many avec Eloquent',
                'excerpt' => 'Articles et tags partagent une table pivot : voyez comment la parcourir proprement.',
                'body' => "La relation `belongsToMany` relie un article à plusieurs tags et un tag à plusieurs articles. La table pivot `post_tag` conserve les deux clés étrangères ainsi que les horodatages.\n\nPour afficher une liste d'articles, chargez la relation avec `with('tags')`. Pour modifier les associations, `sync()` remplace l'état existant en une seule opération et évite les doublons.",
                'category' => 'base-de-donnees',
                'author' => 'karim@mini-cms.test',
                'tags' => ['eloquent', 'sql'],
            ],
            [
                'title' => 'Éviter les requêtes N+1 dans une page de liste',
                'excerpt' => 'Un seul écran peut générer des dizaines de requêtes si les relations ne sont pas chargées ensemble.',
                'body' => "Le problème apparaît lorsqu'une boucle accède à `\$post->category` ou `\$post->user` sans chargement préalable. Chaque itération déclenche alors une nouvelle requête SQL.\n\nLe correctif tient en une ligne : `Post::with('user', 'category', 'tags')->paginate(4)`. Le nombre de requêtes reste stable, même quand la page contient beaucoup d'articles.",
                'category' => 'base-de-donnees',
                'author' => 'youssef@mini-cms.test',
                'tags' => ['eloquent', 'performance'],
            ],
            [
                'title' => 'Indexer les colonnes utiles sans ralentir les écritures',
                'excerpt' => "Un index accélère la lecture, mais il a aussi un coût à l'insertion et à la mise à jour.",
                'body' => "Les colonnes utilisées dans `WHERE`, `ORDER BY` ou les clés étrangères sont de bonnes candidates à un index. Sur une table d'articles, `slug`, `user_id` et `category_id` sont consultés très souvent.\n\nAjouter trop d'index ralentit pourtant les écritures. La bonne approche consiste à mesurer les requêtes réelles avant d'en créer un nouveau.",
                'category' => 'base-de-donnees',
                'author' => 'admin@mini-cms.test',
                'tags' => ['sql', 'performance'],
            ],
            [
                'title' => 'Comprendre les contraintes de clé étrangère en SQLite',
                'excerpt' => 'NULL, suppression en cascade et valeurs par défaut : les détails qui évitent les mauvaises surprises.',
                'body' => "Une clé étrangère garantit qu'un article référence toujours un utilisateur et une catégorie existants. Ici, les colonnes restent nullable pour continuer à exister après la suppression d'un auteur grâce à `nullOnDelete()`.\n\nEn revanche, la table pivot utilise `cascadeOnDelete()` : supprimer un article retire automatiquement ses associations de tags. Ce comportement se teste directement en base.",
                'category' => 'base-de-donnees',
                'author' => 'camille@mini-cms.test',
                'tags' => ['sql', 'php'],
            ],
            [
                'title' => 'Nettoyer les données avec les casts et les mutators',
                'excerpt' => "Un champ booléen ou une date n'a pas besoin d'être converti à la main dans chaque vue.",
                'body' => "La propriété `casts()` du modèle transforme automatiquement `is_published` en booléen et `published_at` en instance de Carbon. Les vues peuvent alors appeler directement `format('d/m/Y')`.\n\nCette centralisation évite les comparaisons fragiles et rend le modèle plus fiable. Elle simplifie aussi les tests, qui manipulent des valeurs PHP natives.",
                'category' => 'base-de-donnees',
                'author' => 'sofia@mini-cms.test',
                'tags' => ['eloquent', 'php'],
            ],
            [
                'title' => 'Sauvegarder et restaurer une base de développement',
                'excerpt' => "Une procédure courte pour repartir d'un état connu avant une démonstration ou un atelier.",
                'body' => "Avec SQLite, une sauvegarde se résume souvent à copier le fichier de la base. Conservez cette copie avant une migration risquée ou une grosse modification des seeders.\n\nPour reconstruire l'environnement, `migrate:fresh --seed` supprime les tables, rejoue les migrations puis insère les données de démonstration. C'est la commande la plus sûre pour un atelier.",
                'category' => 'base-de-donnees',
                'author' => 'karim@mini-cms.test',
                'tags' => ['sql', 'tests'],
            ],
            [
                'title' => 'Préparer des seeders déterministes pour une démo',
                'excerpt' => 'Des titres explicites et des dates décalées rendent chaque présentation reproductible.',
                'body' => "Un seeder aléatoire donne des résultats différents à chaque exécution, ce qui complique la préparation d'un atelier. Définir les titres, les auteurs et les catégories dans un tableau rend la démonstration prévisible.\n\nLes factories gardent leur intérêt pour générer le corps et les horodatages. En combinant les deux approches, on obtient des données réalistes et stables.",
                'category' => 'laravel',
                'author' => 'admin@mini-cms.test',
                'tags' => ['tests', 'laravel'],
            ],
            [
                'title' => "Protéger les routes d'administration avec les Gates",
                'excerpt' => 'Une règle centrale autorise les administrateurs, sauf pour le changement de rôle.',
                'body' => "Les Gates définissent les capacités au niveau de l'application : gérer les catégories, les tags ou les utilisateurs. Le middleware `admin` protège l'accès au groupe de routes correspondant.\n\nLa policy des articles complète ce dispositif en vérifiant la propriété de chaque article. Un administrateur peut tout faire sauf modifier son propre rôle, grâce à une exception explicite dans le `Gate::before`.",
                'category' => 'laravel',
                'author' => 'youssef@mini-cms.test',
                'tags' => ['securite', 'laravel'],
            ],
        ];

        foreach ($posts as $index => $data) {
            $post = Post::factory()->published()->create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
                'user_id' => $users->get($data['author'])->id,
                'category_id' => $categories->get($data['category'])->id,
                'published_at' => now()->subDays($index),
            ]);

            $tagIds = array_map(fn (string $slug) => $tags->get($slug)->id, $data['tags']);

            $post->tags()->attach($tagIds);
        }
    }
}

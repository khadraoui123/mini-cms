<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

beforeEach(function () {
    $this->withoutVite();
});

it('shows the posts list', function () {
    Post::create([
        'title' => 'Premier article',
        'slug' => 'premier-article',
        'body' => 'Contenu du premier article de test.',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee('Premier article');
});

it('shows a message when there is no post', function () {
    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee('Aucun article');
});

it('staggers the scale-in animation of the post cards', function () {
    Post::factory()->published()->count(2)->create();

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee('anim-scale-in')
        ->assertSee('animation-delay: 100ms')
        ->assertSee('hover:-translate-y-1')
        ->assertSee('hover:shadow-2xl hover:shadow-indigo-500/20')
        ->assertSee('group-hover:scale-110')
        ->assertSee('group-hover:translate-x-2');
});

it('renders the mesh background, the animated hero and the dynamic header', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('animate-blob-indigo')
        ->assertSee('bg-[#f7f8fd]')
        ->assertSee('anim-fade-up')
        ->assertSee('style="animation-delay: 100ms"', false)
        ->assertSee('animate-glow')
        ->assertSee('shine-light')
        ->assertSee('id="hero-copy"', false)
        ->assertSee('id="site-header"', false)
        ->assertSee('border-transparent bg-transparent')
        ->assertSee('bg-white/80', false)
        ->assertSee('backdrop-blur-md', false)
        ->assertSee('id="back-to-top"', false)
        ->assertSee('fa-solid fa-arrow-up')
        ->assertSee('window.scrollY > 300', false)
        ->assertSee('window.scrollY > 50', false);
});

it('shows a single post', function () {
    $post = Post::create([
        'title' => 'Article complet',
        'slug' => 'article-complet',
        'body' => 'Texte complet de cet article de test.',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee('Texte complet de cet article de test.');
});

it('returns 404 for an unknown post', function () {
    $this->get('/posts/999')->assertNotFound();
});

it('shows the create form to a logged-in user', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('posts.create'))
        ->assertOk()
        ->assertSee('Nouvel article');
});

it('shows only published posts on the home page', function () {
    Post::create([
        'title' => 'Article visible',
        'slug' => 'article-visible',
        'body' => 'Cet article est publie et doit apparaitre.',
        'is_published' => true,
        'published_at' => now(),
    ]);
    Post::create([
        'title' => 'Article masque',
        'slug' => 'article-masque',
        'body' => 'Cet article est un brouillon et reste cache.',
        'is_published' => false,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Article visible')
        ->assertDontSee('Article masque');
});

it('filters posts by title with the search field', function () {
    Post::factory()->published()->create(['title' => 'Laravel en action']);
    Post::factory()->published()->create(['title' => 'Tailwind en action']);

    $this->get(route('posts.index', ['search' => 'Laravel']))
        ->assertOk()
        ->assertSee('Laravel en action')
        ->assertDontSee('Tailwind en action');
});

it('filters posts by category', function () {
    $category = Category::factory()->create(['name' => 'Laravel']);
    Post::factory()->published()->create(['category_id' => $category->id, 'title' => 'Article dans Laravel']);
    Post::factory()->published()->create(['title' => 'Article sans categorie']);

    $this->get(route('posts.index', ['category_id' => $category->id]))
        ->assertOk()
        ->assertSee('Article dans Laravel')
        ->assertDontSee('Article sans categorie');
});

it('keeps the active filters in the pagination links', function () {
    $category = Category::factory()->create();
    Post::factory(6)->published()->sequence(fn ($sequence) => [
        'title' => 'Laravel article '.$sequence->index,
        'category_id' => $category->id,
    ])->create();

    $this->get(route('posts.index', ['search' => 'Laravel', 'category_id' => $category->id]))
        ->assertOk()
        ->assertSee('search=Laravel')
        ->assertSee('category_id='.$category->id);
});

it('renders a themed CSS thumbnail instead of an external image on each post card', function () {
    $category = Category::factory()->create(['name' => 'Laravel', 'slug' => 'laravel']);
    Post::factory()->published()->create(['category_id' => $category->id]);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee('fa-solid fa-code')
        ->assertSee('from-rose-500 via-red-500 to-orange-400')
        ->assertSee($category->name)
        ->assertDontSee('picsum.photos');
});

it('renders the themed CSS thumbnail on the post detail page', function () {
    $category = Category::factory()->create(['name' => 'Base de données', 'slug' => 'base-de-donnees']);
    $post = Post::factory()->published()->create(['category_id' => $category->id]);

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee('fa-solid fa-database')
        ->assertSee('from-emerald-500 via-teal-500 to-cyan-500')
        ->assertDontSee('picsum.photos');
});

it('shows the reading time and the word count in the detail metadata', function () {
    $post = Post::factory()->published()->create([
        'title' => 'Article avec métadonnées',
        'body' => 'Un seul mot.',
    ]);

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee('1 min de lecture')
        ->assertSee('3 mots');
});

it('shows the author and related posts in the detail sidebar', function () {
    $author = User::factory()->create(['name' => 'Wajih']);
    $category = Category::factory()->create(['name' => 'Laravel']);
    $post = Post::factory()->published()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);
    Post::factory(2)->published()->create(['category_id' => $category->id]);

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee('Auteur')
        ->assertSee('Dans la même catégorie')
        ->assertSee($category->name)
        ->assertSee($author->name);
});

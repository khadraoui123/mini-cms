<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

beforeEach(function () {
    $this->withoutVite();
});

it('renders the dashboard with the site statistics', function () {
    User::factory(2)->create();
    Category::factory()->create();
    Tag::factory(3)->create();
    Post::factory(4)->published()->create();

    $this->get(route('dashboard'))
        ->assertOk()
        ->assertViewHas('postsCount', 4)
        ->assertViewHas('usersCount', 2)
        ->assertViewHas('categoriesCount', 1)
        ->assertViewHas('tagsCount', 3);
});

it('shows only the three latest published posts on the dashboard', function () {
    Post::factory()->published()->create([
        'title' => 'Ancien article du dashboard',
        'published_at' => now()->subYear(),
    ]);
    Post::factory(3)->published()->create(['published_at' => now()]);

    $this->get(route('dashboard'))
        ->assertOk()
        ->assertViewHas('latestPosts', fn ($posts) => $posts->count() === 3)
        ->assertDontSee('Ancien article du dashboard');
});

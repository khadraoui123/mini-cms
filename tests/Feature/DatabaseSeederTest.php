<?php

use App\Models\Post;

it('seeds a browsable blog with linked published articles', function () {
    $this->withoutVite();

    $this->freezeTime();
    $this->seed();

    $this->assertDatabaseCount('users', 5);
    $this->assertDatabaseCount('categories', 3);
    $this->assertDatabaseCount('tags', 10);
    $this->assertDatabaseCount('posts', 20);
    $this->assertDatabaseCount('post_tag', 40);
    $this->assertDatabaseMissing('posts', ['is_published' => false]);
    $this->assertDatabaseMissing('posts', ['user_id' => null]);
    $this->assertDatabaseMissing('posts', ['category_id' => null]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Derniers articles publiés')
        ->assertSee('Laravel');

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee('Tous les articles')
        ->assertSee('20 articles trouvés');

    $post = Post::query()->latest('published_at')->firstOrFail();

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee($post->title)
        ->assertSee('Dans la même catégorie');
});

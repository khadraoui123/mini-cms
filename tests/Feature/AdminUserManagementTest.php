<?php

use App\Models\Post;
use App\Models\User;

beforeEach(function () {
    $this->withoutVite();
});

it('shows the delete control and the admin link to an administrator', function () {
    $admin = User::factory()->admin()->create();
    $author = User::factory()->create();

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertOk()
        ->assertSee(route('admin.users.destroy', $author), false)
        ->assertSee('Supprimer')
        ->assertSee('Gestion des utilisateurs');
});

it('hides the admin link from a regular author', function () {
    $author = User::factory()->create();

    $this->actingAs($author)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertDontSee('Gestion des utilisateurs');
});

it('lets an admin delete an author and reassign their posts', function () {
    $admin = User::factory()->admin()->create();
    $author = User::factory()->create();
    $posts = Post::factory()->count(2)->for($author)->create();

    $this->actingAs($admin)
        ->delete(route('admin.users.destroy', $author))
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('success', 'Utilisateur supprimé. Ses articles ont été réassignés.');

    $this->assertModelMissing($author);

    foreach ($posts as $post) {
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'user_id' => $admin->id]);
    }
});

it('reassigns the posts of a deleted admin to the administrator who deletes them', function () {
    $admin = User::factory()->admin()->create();
    $otherAdmin = User::factory()->admin()->create();
    $post = Post::factory()->for($otherAdmin)->create();

    $this->actingAs($admin)
        ->delete(route('admin.users.destroy', $otherAdmin))
        ->assertRedirect(route('admin.users.index'));

    $this->assertModelMissing($otherAdmin);
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'user_id' => $admin->id]);
});

it('forbids an admin to delete their own account', function () {
    $admin = User::factory()->admin()->create();
    $post = Post::factory()->for($admin)->create();

    $this->actingAs($admin)
        ->delete(route('admin.users.destroy', $admin))
        ->assertForbidden();

    $this->assertModelExists($admin);
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'user_id' => $admin->id]);
});

it('forbids a regular author to delete a user', function () {
    $author = User::factory()->create();
    $target = User::factory()->create();

    $this->actingAs($author)
        ->delete(route('admin.users.destroy', $target))
        ->assertForbidden();

    $this->assertModelExists($target);
});

it('redirects a guest to the login page', function () {
    $target = User::factory()->create();

    $this->delete(route('admin.users.destroy', $target))
        ->assertRedirect(route('login'));

    $this->assertModelExists($target);
});

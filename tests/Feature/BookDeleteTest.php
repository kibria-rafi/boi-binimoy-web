<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_delete_own_book(): void
    {
        $owner = User::factory()->create();
        $book = Book::create([
            'user_id' => $owner->id,
            'title' => 'Test Book',
            'author' => 'Author Name',
            'description' => 'Test description',
            'condition' => 'good',
            'status' => 'available',
        ]);

        $response = $this->actingAs($owner)
            ->delete(route('books.destroy', $book->id));

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_user_cannot_delete_someone_else_book(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $book = Book::create([
            'user_id' => $owner->id,
            'title' => 'Another Book',
            'author' => 'Author Name',
            'description' => 'Test description',
            'condition' => 'fair',
            'status' => 'available',
        ]);

        $response = $this->actingAs($otherUser)
            ->delete(route('books.destroy', $book->id));

        $response->assertForbidden();
        $this->assertDatabaseHas('books', ['id' => $book->id]);
    }
}

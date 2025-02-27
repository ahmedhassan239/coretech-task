<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPostSubmittedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NewPostSubmittedNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function notification_contains_correct_data()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Post', // ✅ Explicitly set title
        ]);

        $notification = new NewPostSubmittedNotification($post);
        $data = $notification->toArray($user);

        $this->assertEquals($post->id, $data['post_id']);
        $this->assertEquals($post->user_id, $data['user_id']);
    }
}

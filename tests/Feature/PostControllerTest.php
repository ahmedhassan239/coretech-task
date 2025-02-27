<?php

namespace Tests\Feature;

use App\Jobs\NotifyAdminsNewPostJob;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Notifications\NewPostSubmittedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Notification;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function job_sends_notifications_to_admins()
    {
        Notification::fake();

        $adminRole = Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);

        $user = User::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Post',
        ]);

        $job = new NotifyAdminsNewPostJob($post);
        $job->handle();

        Notification::assertSentTo(
            [$admin],
            NewPostSubmittedNotification::class,
            function ($notification) use ($post) {
                $data = $notification->toArray($post->user);
                return $data['post_id'] === $post->id;
            }
        );
    }
}

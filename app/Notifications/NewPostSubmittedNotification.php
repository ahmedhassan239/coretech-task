<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Post;

class NewPostSubmittedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database']; // You can choose the delivery channels
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Post Submitted')
            ->greeting('Hello Admin!')
            ->line('A new post has been submitted and is awaiting approval.')
            ->line('Post Content: ' . $this->post->content)
            ->action('Review Post', url('/admin/posts/'.$this->post->id));
    }

    public function toArray($notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'user_id' => $this->post->user_id,
            'content' => $this->post->content,
        ];
    }
}

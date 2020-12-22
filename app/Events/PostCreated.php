<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newPost;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($newPost)
  {
    $this->newpoPt  = $newPost;  }

  public function broadcastOn()
  {
      return new PrivateChannel('user-');
  }

  public function broadcastAs()
  {
      return 'new-post';
  }
}

<?php

namespace App\Jobs;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class BatchNotifyPostCommentators implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private PostService $postService;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly Post $post
    ) {
        $this->postService = app()->make(PostService::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $batch = Bus::batch([])->dispatch();
        $uniqueEmails = $this->postService->getCommentatorsEmail($this->post);
        foreach ($uniqueEmails as $key => $email) {
            $batch->add(new SendNotify($email, $key));
        }
    }
}

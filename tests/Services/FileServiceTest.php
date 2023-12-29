<?php

namespace Tests\Services;

use App\Services\FileService;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Jobs\ScalePostImage;
use Illuminate\Support\Facades\Queue;


class FileServiceTest extends TestCase
{

    /** @test */
    public function it_saves_an_image_and_dispatches_job_when_file_is_provided()
    {
        Storage::fake('public');
        Queue::fake();

        $file = UploadedFile::fake()->image('test.jpg');
        $service = new FileService();

        $filePath = $service->saveImage($file);

        Storage::disk('public')->assertExists($filePath);

        Queue::assertPushed(ScalePostImage::class, function ($job) use ($filePath) {
            return $job->path === $filePath;
        });
    }

    /** @test */
    public function it_returns_null_when_no_file_is_provided()
    {
        $service = new FileService();

        $result = $service->saveImage();

        $this->assertNull($result);
    }
}

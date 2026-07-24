<?php

namespace Tests\Unit;

use App\Support\PublicUpload;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PublicUploadTest extends TestCase
{
    public function test_it_stores_files_in_a_safe_public_upload_directory(): void
    {
        $temporaryFile = tempnam(sys_get_temp_dir(), 'mudea-upload');
        file_put_contents($temporaryFile, 'upload content');

        $file = new UploadedFile(
            $temporaryFile,
            'sample.txt',
            'text/plain',
            null,
            true
        );

        $path = PublicUpload::store($file, '../../unsafe-folder');

        $this->assertSame('upload/unsafe-folder/' . $file->hashName(), $path);
        $this->assertFileExists(public_path($path));
        $this->assertFileExists(public_path('upload/unsafe-folder/' . $file->hashName()));

        unlink($temporaryFile);
    }

    public function test_it_deletes_files_from_the_public_upload_directory(): void
    {
        $file = UploadedFile::fake()->create('sample.txt', 100, 'text/plain');

        $path = PublicUpload::store($file, 'documents');
        PublicUpload::delete($path);

        $this->assertFileDoesNotExist(public_path($path));
    }
}

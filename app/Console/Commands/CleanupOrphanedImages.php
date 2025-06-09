<?php

namespace App\Console\Commands;

use App\Models\EditorImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CleanupOrphanedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:cleanup-orphaned
                            {--hours=24 : Number of hours before considering an image orphaned}
                            {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up orphaned editor images from Cloudinary and database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hours = $this->option('hours');
        $dryRun = $this->option('dry-run');

        $this->info("Finding orphaned images older than {$hours} hours...");

        $orphanedImages = EditorImage::oldOrphaned($hours)->get();

        if ($orphanedImages->count() === 0) {
            $this->info('No orphaned images found.');

            return Command::SUCCESS;
        }

        $this->info("Found {$orphanedImages->count()} orphaned images.");

        if ($dryRun) {
            $this->info('Dry run mode - showing what would be deleted:');
            foreach ($orphanedImages as $image) {
                $this->line(" - {$image->original_filename} (ID: {$image->id}, Public ID: {$image->public_id})");
            }

            return Command::SUCCESS;
        }

        $deletedCount = 0;
        $failedCount = 0;
        $bar = $this->output->createProgressBar($orphanedImages->count());

        foreach ($orphanedImages as $image) {
            try {
                if ($image->deleteWithCloudinary()) {
                    $deletedCount++;
                    Log::info('Deleted orphaned image', [
                        'image_id' => $image->id,
                        'public_id' => $image->public_id,
                        'user_id' => $image->user_id,
                    ]);
                } else {
                    $failedCount++;
                    $this->error("\nFailed to delete image: {$image->original_filename}");
                }
            } catch (\Exception $e) {
                $failedCount++;
                $this->error("\nError deleting image {$image->id}: ".$e->getMessage());
                Log::error('Failed to delete orphaned image', [
                    'image_id' => $image->id,
                    'error' => $e->getMessage(),
                ]);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info('Cleanup complete!');
        $this->info("Deleted: {$deletedCount} images");

        if ($failedCount > 0) {
            $this->warn("Failed: {$failedCount} images");
        }

        return Command::SUCCESS;
    }
}

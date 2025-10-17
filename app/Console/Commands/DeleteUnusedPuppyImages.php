<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Puppy;
use Illuminate\Support\Facades\Storage;

class DeleteUnusedPuppyImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteUnusedPuppyImages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up unused images that are no longer referenced in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $storedImages = Storage::disk('public')->files('puppies');

        $usedImages = Puppy::pluck('image_url')
            ->map(fn($url) => str_replace('/storage/', '', $url))
            ->toArray();

        $unusedImages = array_diff($storedImages, $usedImages);

        $totalCount = count($unusedImages);

        if ($totalCount === 0) {
            $this->info('There are no unused images.');
            return;
        }

        $this->info('Found ' . $totalCount . ' unused images.');
        $firstThree = array_slice($unusedImages, 0, 3);

        foreach($firstThree as $image) {
            $this->line('- ' . $image);
        }

        if ($totalCount > 3) {
            $remainingCount = $totalCount - 3;
            $this->line("+ {$remainingCount} more...");
        }

        if ($this->confirm('Do you really want to delete all images?')) {
            foreach($unusedImages as $image) {
                Storage::disk('public')->delete($image);
                $this->info('Deleted image: ' . $image);
            }

            $this->info('Unused images have been deleted.');
        } else {
            $this->info('Operation canceled');
        }
    }
}

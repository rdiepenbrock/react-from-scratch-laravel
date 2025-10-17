<?php

namespace Database\Seeders;

use App\Actions\OptimizeWebpImageAction;
use App\Models\Puppy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PuppySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $puppies = [
            ['name' => 'Bella', 'trait' => 'Always happy', 'image' => '10.jpg'],
            ['name' => 'Rex', 'trait' => 'Fetches everything', 'image' => '9.jpg'],
            ['name' => 'Luna', 'trait' => 'Howls at the moon', 'image' => '8.jpg'],
            ['name' => 'Yoko', 'trait' => 'Ready for anything', 'image' => '6.jpg'],
            ['name' => 'Russ', 'trait' => 'Ready to save the world', 'image' => '5.jpg'],
            ['name' => 'Pupi', 'trait' => 'Loves cheese', 'image' => '4.jpg'],
            ['name' => 'Leia', 'trait' => 'Enjoys naps', 'image' => '3.jpg'],
            ['name' => 'Chase', 'trait' => 'Very good boi', 'image' => '2.jpg'],
            ['name' => 'Frisket', 'trait' => 'Mother of all pups', 'image' => '1.jpg'],
            ['name' => 'Max', 'trait' => 'Loves to run', 'image' => '11.jpg'],
            ['name' => 'Charlie', 'trait' => 'Gentle giant', 'image' => '12.jpg'],
            ['name' => 'Rocky', 'trait' => 'Mountain explorer', 'image' => '13.jpg'],
            ['name' => 'Bailey', 'trait' => 'Beach lover', 'image' => '14.jpg'],
            ['name' => 'Lucy', 'trait' => 'Cuddle expert', 'image' => '15.jpg'],
            ['name' => 'Cooper', 'trait' => 'Ball enthusiast', 'image' => '16.jpg'],
            ['name' => 'Daisy', 'trait' => 'Flower sniffer', 'image' => '17.jpg'],
            ['name' => 'Milo', 'trait' => 'Professional napper', 'image' => '18.jpg'],
            ['name' => 'Sadie', 'trait' => 'Squirrel watcher', 'image' => '19.jpg'],
            ['name' => 'Tucker', 'trait' => 'Treat connoisseur', 'image' => '20.jpg'],
            ['name' => 'Molly', 'trait' => 'Sock collector', 'image' => '21.jpg'],
            ['name' => 'Bear', 'trait' => 'Gentle soul', 'image' => '22.jpg'],
            ['name' => 'Sophie', 'trait' => 'Dancing queen', 'image' => '1.jpg'],
            ['name' => 'Duke', 'trait' => 'Guardian angel', 'image' => '2.jpg'],
            ['name' => 'Maggie', 'trait' => 'Snow lover', 'image' => '3.jpg'],
            ['name' => 'Winston', 'trait' => 'Dignified gentleman', 'image' => '4.jpg'],
            ['name' => 'Penny', 'trait' => 'Pocket rocket', 'image' => '5.jpg'],
            ['name' => 'Oliver', 'trait' => 'Food critic', 'image' => '6.jpg'],
            ['name' => 'Ruby', 'trait' => 'Sunset chaser', 'image' => '7.jpg'],
            ['name' => 'Jack', 'trait' => 'Adventure seeker', 'image' => '8.jpg'],
            ['name' => 'Coco', 'trait' => 'Swimming champion', 'image' => '9.jpg'],
            ['name' => 'Murphy', 'trait' => 'Wise elder', 'image' => '10.jpg'],
            ['name' => 'Riley', 'trait' => 'Tail wagger', 'image' => '11.jpg'],
            ['name' => 'Zeus', 'trait' => 'Thunder buddy', 'image' => '12.jpg'],
            ['name' => 'Willow', 'trait' => 'Tree climber', 'image' => '13.jpg'],
            ['name' => 'Bruno', 'trait' => 'Loyal friend', 'image' => '14.jpg'],
            ['name' => 'Rosie', 'trait' => 'Garden helper', 'image' => '15.jpg'],
            ['name' => 'Teddy', 'trait' => 'Hugging expert', 'image' => '16.jpg'],
            ['name' => 'Millie', 'trait' => 'Bird watcher', 'image' => '17.jpg'],
            ['name' => 'Buddy', 'trait' => 'Friendly to everyone', 'image' => '18.jpg'],
            ['name' => 'Nova', 'trait' => 'Star gazer', 'image' => '19.jpg'],
            ['name' => 'Leo', 'trait' => 'Brave heart', 'image' => '20.jpg'],
            ['name' => 'Pepper', 'trait' => 'Spicy personality', 'image' => '21.jpg'],
            ['name' => 'Scout', 'trait' => 'Trail blazer', 'image' => '22.jpg'],
            ['name' => 'Ginger', 'trait' => 'Cookie thief', 'image' => '1.jpg'],
            ['name' => 'Oscar', 'trait' => 'Couch potato', 'image' => '2.jpg'],
            ['name' => 'Hazel', 'trait' => 'Leaf chaser', 'image' => '3.jpg'],
            ['name' => 'Finn', 'trait' => 'Wave rider', 'image' => '4.jpg'],
            ['name' => 'Nala', 'trait' => 'Queen of hearts', 'image' => '5.jpg'],
            ['name' => 'Archie', 'trait' => 'Stick collector', 'image' => '6.jpg'],
            ['name' => 'Lily', 'trait' => 'Butterfly chaser', 'image' => '7.jpg'],
            ['name' => 'Bentley', 'trait' => 'Car enthusiast', 'image' => '8.jpg'],
            ['name' => 'Zoey', 'trait' => 'Zen master', 'image' => '9.jpg'],
            ['name' => 'Thor', 'trait' => 'Storm braver', 'image' => '10.jpg'],
            ['name' => 'Piper', 'trait' => 'Music lover', 'image' => '11.jpg'],
            ['name' => 'Atlas', 'trait' => 'World explorer', 'image' => '12.jpg'],
            ['name' => 'Gracie', 'trait' => 'Peace keeper', 'image' => '13.jpg'],
            ['name' => 'Banjo', 'trait' => 'Party starter', 'image' => '14.jpg'],
            ['name' => 'River', 'trait' => 'Water baby', 'image' => '15.jpg'],
            ['name' => 'Maple', 'trait' => 'Autumn lover', 'image' => '16.jpg'],
            ['name' => 'Storm', 'trait' => 'Weather watcher', 'image' => '17.jpg'],
        ];

        $user = User::first();

        $optimizer = new OptimizeWebpImageAction();

        foreach ($puppies as $puppy) {

            $input = base_path('seed_images/' . $puppy['image']);
            $optimized = $optimizer->handle($input);
            $path = 'puppies/' . $optimized['fileName'];

            Storage::disk('public')->put($path, $optimized['webpString']);

            Puppy::create([
               'user_id' => $user->id,
               'name' => $puppy['name'],
               'trait' => $puppy['trait'],
               'image_url' => Storage::url($path),
            ]);
        }
    }
}

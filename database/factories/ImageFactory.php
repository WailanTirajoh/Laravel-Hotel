<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $room_id = Room::all()->random()->id;
        $room = Room::find($room_id);
        $room_number = $room->number;
        $path = 'public/img/room/'.$room_number.'/';
        if (! is_dir($path)) {
            mkdir($path);
        }

        return [
            'room_id' => $room_id,
            'url' => $this->faker->image($path, 640, 480, null, false),
        ];
    }
}

<?php

use Faker\Factory as Faker;
use App\Models\destinasi;
use App\Repositories\destinasiRepository;

trait MakedestinasiTrait
{
    /**
     * Create fake instance of destinasi and save it in database
     *
     * @param array $destinasiFields
     * @return destinasi
     */
    public function makedestinasi($destinasiFields = [])
    {
        /** @var destinasiRepository $destinasiRepo */
        $destinasiRepo = App::make(destinasiRepository::class);
        $theme = $this->fakedestinasiData($destinasiFields);
        return $destinasiRepo->create($theme);
    }

    /**
     * Get fake instance of destinasi
     *
     * @param array $destinasiFields
     * @return destinasi
     */
    public function fakedestinasi($destinasiFields = [])
    {
        return new destinasi($this->fakedestinasiData($destinasiFields));
    }

    /**
     * Get fake data of destinasi
     *
     * @param array $postFields
     * @return array
     */
    public function fakedestinasiData($destinasiFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'kode' => $fake->word,
            'nama' => $fake->word,
            'deskripsi' => $fake->word,
            'longitude' => $fake->word,
            'latitude' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $destinasiFields);
    }
}

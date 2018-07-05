<?php

use Faker\Factory as Faker;
use App\Models\bahasa;
use App\Repositories\bahasaRepository;

trait MakebahasaTrait
{
    /**
     * Create fake instance of bahasa and save it in database
     *
     * @param array $bahasaFields
     * @return bahasa
     */
    public function makebahasa($bahasaFields = [])
    {
        /** @var bahasaRepository $bahasaRepo */
        $bahasaRepo = App::make(bahasaRepository::class);
        $theme = $this->fakebahasaData($bahasaFields);
        return $bahasaRepo->create($theme);
    }

    /**
     * Get fake instance of bahasa
     *
     * @param array $bahasaFields
     * @return bahasa
     */
    public function fakebahasa($bahasaFields = [])
    {
        return new bahasa($this->fakebahasaData($bahasaFields));
    }

    /**
     * Get fake data of bahasa
     *
     * @param array $postFields
     * @return array
     */
    public function fakebahasaData($bahasaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'kode' => $fake->word,
            'bahasa' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $bahasaFields);
    }
}

<?php

use Faker\Factory as Faker;
use App\Models\berita;
use App\Repositories\beritaRepository;

trait MakeberitaTrait
{
    /**
     * Create fake instance of berita and save it in database
     *
     * @param array $beritaFields
     * @return berita
     */
    public function makeberita($beritaFields = [])
    {
        /** @var beritaRepository $beritaRepo */
        $beritaRepo = App::make(beritaRepository::class);
        $theme = $this->fakeberitaData($beritaFields);
        return $beritaRepo->create($theme);
    }

    /**
     * Get fake instance of berita
     *
     * @param array $beritaFields
     * @return berita
     */
    public function fakeberita($beritaFields = [])
    {
        return new berita($this->fakeberitaData($beritaFields));
    }

    /**
     * Get fake data of berita
     *
     * @param array $postFields
     * @return array
     */
    public function fakeberitaData($beritaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'judul' => $fake->word,
            'isi' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $beritaFields);
    }
}

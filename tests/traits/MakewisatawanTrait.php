<?php

use Faker\Factory as Faker;
use App\Models\wisatawan;
use App\Repositories\wisatawanRepository;

trait MakewisatawanTrait
{
    /**
     * Create fake instance of wisatawan and save it in database
     *
     * @param array $wisatawanFields
     * @return wisatawan
     */
    public function makewisatawan($wisatawanFields = [])
    {
        /** @var wisatawanRepository $wisatawanRepo */
        $wisatawanRepo = App::make(wisatawanRepository::class);
        $theme = $this->fakewisatawanData($wisatawanFields);
        return $wisatawanRepo->create($theme);
    }

    /**
     * Get fake instance of wisatawan
     *
     * @param array $wisatawanFields
     * @return wisatawan
     */
    public function fakewisatawan($wisatawanFields = [])
    {
        return new wisatawan($this->fakewisatawanData($wisatawanFields));
    }

    /**
     * Get fake data of wisatawan
     *
     * @param array $postFields
     * @return array
     */
    public function fakewisatawanData($wisatawanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'fullname' => $fake->word,
            'email' => $fake->word,
            'jenis_kelamin' => $fake->word,
            'nomor_tlp' => $fake->word,
            'negara' => $fake->word,
            'tanggal_lahir' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $wisatawanFields);
    }
}

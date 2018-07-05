<?php

use Faker\Factory as Faker;
use App\Models\pemandu;
use App\Repositories\pemanduRepository;

trait MakepemanduTrait
{
    /**
     * Create fake instance of pemandu and save it in database
     *
     * @param array $pemanduFields
     * @return pemandu
     */
    public function makepemandu($pemanduFields = [])
    {
        /** @var pemanduRepository $pemanduRepo */
        $pemanduRepo = App::make(pemanduRepository::class);
        $theme = $this->fakepemanduData($pemanduFields);
        return $pemanduRepo->create($theme);
    }

    /**
     * Get fake instance of pemandu
     *
     * @param array $pemanduFields
     * @return pemandu
     */
    public function fakepemandu($pemanduFields = [])
    {
        return new pemandu($this->fakepemanduData($pemanduFields));
    }

    /**
     * Get fake data of pemandu
     *
     * @param array $postFields
     * @return array
     */
    public function fakepemanduData($pemanduFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'fullname' => $fake->word,
            'email' => $fake->word,
            'jenis_kelamin' => $fake->word,
            'nomor_tlp' => $fake->word,
            'longitude' => $fake->word,
            'latitude' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $pemanduFields);
    }
}

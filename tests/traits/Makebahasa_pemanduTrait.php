<?php

use Faker\Factory as Faker;
use App\Models\bahasa_pemandu;
use App\Repositories\bahasa_pemanduRepository;

trait Makebahasa_pemanduTrait
{
    /**
     * Create fake instance of bahasa_pemandu and save it in database
     *
     * @param array $bahasaPemanduFields
     * @return bahasa_pemandu
     */
    public function makebahasa_pemandu($bahasaPemanduFields = [])
    {
        /** @var bahasa_pemanduRepository $bahasaPemanduRepo */
        $bahasaPemanduRepo = App::make(bahasa_pemanduRepository::class);
        $theme = $this->fakebahasa_pemanduData($bahasaPemanduFields);
        return $bahasaPemanduRepo->create($theme);
    }

    /**
     * Get fake instance of bahasa_pemandu
     *
     * @param array $bahasaPemanduFields
     * @return bahasa_pemandu
     */
    public function fakebahasa_pemandu($bahasaPemanduFields = [])
    {
        return new bahasa_pemandu($this->fakebahasa_pemanduData($bahasaPemanduFields));
    }

    /**
     * Get fake data of bahasa_pemandu
     *
     * @param array $postFields
     * @return array
     */
    public function fakebahasa_pemanduData($bahasaPemanduFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id_pemandu' => $fake->randomDigitNotNull,
            'id_bahasa' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $bahasaPemanduFields);
    }
}

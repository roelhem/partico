<?php

namespace Database\Factories;

use App\Models\EmailAddress;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contact_id' => function() {
                $contact = Contact::query()->inRandomOrder()->first();
                if($contact instanceof Contact) {
                    return $contact->id;
                } else {
                    return Contact::factory()->create()->id;
                }
            },
            'label' => $this->faker->word,
            'email_address' => $this->faker->safeEmail,
            'remarks' => 'Gegenereerd door een factory.'
        ];
    }
}

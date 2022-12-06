<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class EmailValidation implements Rule
{

    private $mail;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @return bool
     */
    public function passes()
    {
        try {

            $response = $this->mailgunValidation($this->mail);

        } catch (\Exception) {

            return false;

        }

        if ($response->successful()) {

            if (!$response->json('mailbox_verification')) {
                return false;
            }

            if ($response->json('is_disposable_address')) {
                return false;
            }

            return $response->json('is_valid');
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }

    /**
     * @author Eduardo da Silva
     * @since 04/12/2022
     * @param $mail
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Retornar se o email é válido
     */
    private function mailgunValidation($mail) {
        return Http::withBasicAuth('api', config('mail.mailers.mailgun.public_key'))
            ->asForm()->post('https://api.mailgun.net/v4/address/validate', [
                'address' => $mail
            ]);
    }
}

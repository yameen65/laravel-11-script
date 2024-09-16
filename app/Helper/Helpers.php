<?php


namespace App\Helper;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;


trait Helpers
{
    /**
     * Send OTP via Twilio.
     *
     * @param string $phoneNumber
     * @return bool
     * @param string $code
     * @return void
     */

     public function isValidPhoneNumber($phoneNumber)
     {
         if (is_array($phoneNumber) && isset($phoneNumber['phone'])) {
             $phoneNumber = $phoneNumber['phone']; 
         }
     
         $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber); 
     
         if (substr($phoneNumber, 0, 1) !== '+') {
             $phoneNumber = '+' . $phoneNumber; 
         }
     
         return $phoneNumber;
     }
     
    public function sendOtpViaTwilio($formattedPhoneNumber, $code)
    {
        try {
            $twilio = new \Twilio\Rest\Client(
                Config::get('services.twilio.sid'),
                Config::get('services.twilio.token')
            );

            $message = $twilio->messages->create(
                $formattedPhoneNumber,
                [
                    'from' => Config::get('services.twilio.from'),
                    'body' => "Your verification code is: $code"
                ]
            );

            Log::info("Verification code sent via SMS with ID: " . $message->sid);
        } catch (\Throwable $th) {
            Log::error("Failed to send OTP via Twilio: " . $th->getMessage());
            throw $th;
        }
    }
}

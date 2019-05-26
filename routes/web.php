<?php

use Twilio\Jwt\ClientToken;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
Route::get("/mailTest", function () {
    $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
    $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
   try
    {
    $client = new Client(['auth' => [$accountSid, $authToken]]);
    $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/'.$accountSid.'/Messages.json',
    ['form_params' => [
    'Body' => 'CODE: 97583425', 
    'To' => "+963949042001",
    'From' => '+17868285788'
    ]]);
    
    return $result;
    }
    catch (Exception $e)
    {
    echo "Error: " . $e->getMessage();
    }
    

});

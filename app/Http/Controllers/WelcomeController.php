<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public static function encode_personal_link($email)
    {
        $yourPassbaseLink = "https://verify.passbase.com/user-id-check";

        $hash_map = array(
            'prefill_attributes' => array(
                'email' => $email,
                'country' => 'de'
            ),
        );

        $encodedAttributes = base64_encode(json_encode($hash_map));
        $encodedLink = $yourPassbaseLink."?p=".$encodedAttributes;
        return $encodedLink;
    }
}

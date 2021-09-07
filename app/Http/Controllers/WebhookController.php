<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ManSha;
use App\Models\User;
use Exception;
use Passbase\Configuration;
use Passbase\api\IdentityApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    protected $apiInstance;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('X-API-KEY', env('PASSBASE_SECRET_KEY'));
        $this->apiInstance = new IdentityApi(
            new Client(),
            $config
        );
    }

    public function receive_passbase_webhook(Request $request)
    {
        $webhook = $request->json()->all();
        $event_type = $webhook['event'];

        switch ($event_type) {
            case "VERIFICATION_COMPLETED":
                $this->process_verification_completed($webhook);
                break;
            case "VERIFICATION_REVIEWED":
                $this->process_verification_reviewed($webhook);
                break;
        }

        return response('Received', 200);
    }

    private function process_verification_completed($webhook)
    {
        error_log("VERIFICATION_COMPLETED");
    }

    private function process_verification_reviewed($webhook)
    {
        error_log("VERIFICATION_REVIEWED");
        $details = $this->get_identity_for_id($webhook['key']);
        $this->update_verification_status($details);
    }

    private function update_verification_status($details)
    {
        error_log($details);

        // Update status of user in your db
        $email = $details['owner']['email'];
        $status = $details['status'];
        ManSha::where('email','hasib.0951@gmail.com')->update([
            'status' => $status
        ]);
    }

    // Make Passbase API call to get details of an identity
    private function get_identity_for_id($key)
    {
        try {
            $result = $this->apiInstance->getIdentityById($key);
            return $result;
        } catch (Exception $e) {
            echo 'Exception when calling IdentityApi->getIdentityById: ', $e->getMessage(), PHP_EOL;
        }
    }
}

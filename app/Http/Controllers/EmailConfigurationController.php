<?php

namespace App\Http\Controllers;

use App\Mail\DynamicEmail;
use App\Models\EmailConfiguration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailConfigurationController extends Controller
{
    public function createConfiguration(Request $request) {

        $configuration  =   EmailConfiguration::create([
            "user_id"       =>      Auth::user()->id,
            "driver"        =>      $request->driver,
            "host"          =>      $request->hostName,
            "port"          =>      $request->port,
            // "encryption"    =>      $request->encryption,
            "user_name"     =>      $request->userName,
            "password"      =>      $request->password,
            "sender_name"   =>      $request->senderName,
            "sender_email"  =>      $request->senderEmail
        ]);

        if(!is_null($configuration)) {
           return back()->with("success", "Email configuration created.");
        }

        else {
            return back()->with("failed", "Email configuration not created.");
        }
    }

    public function composeEmail() {
        return view("email");
    }

    public function sendEmail(Request $request) {
        $this->setMailConfig();
        $toEmail = $request->emailAddress;
        $data = array(
            "message" => $request->message
        );

        try {
            Mail::to($toEmail)->send(new DynamicEmail($data));
            return back()->with("success", "E-mail sent successfully!");
        } catch (Exception $e) {
            exception: Log::error($e->getMessage());
            return back()->with("failed", "E-mail not sent!");
        }
    }

    private function setMailConfig() {
        $configuration = EmailConfiguration::where("user_id", Auth::user()->id)->first();
        if (!is_null($configuration)) {
            $config = [
                'default' => 'smtp',
                'mailers' => [
                    'smtp' => [
                        'transport' => 'smtp',
                        'host' => $configuration->host,
                        'port' => $configuration->port,
                        'username' => $configuration->user_name,
                        'password' => $configuration->password,
                    ],
                ],
                'from' => [
                    'address' => $configuration->sender_email, // Consider updating this to $configuration->sender_email,
                    'name' => $configuration->sender_name,
                ],
            ];
            Config::set('mail', $config);
        }
    }
}
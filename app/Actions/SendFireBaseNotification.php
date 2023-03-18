<?php


namespace App\Actions;


use App\Model\TRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendFireBaseNotification extends Action
{
    protected $title;
    protected $body;
    protected $to;
    protected $user_id;
    protected $url;
    protected $request_id;
    private const SERVER_API_KEY = 'AAAAhdln0A0:APA91bF8GURVszQNcgedXnj3WrGFlZnfD2UgA85m_zemylKldqrBrVlaxzLMbzV-QVg6HS49u-9HBHJm9WDBq9pdM7qHyBuQ5xG13v89UPScHIw2lxFP__n7aPDrNLiLfVrakGaWABuf';

    public function __construct($title = null, $body = null, $user_id = null)
//    public function __construct($title=null, $body=null, $to = null, $user_id = null,$request_id = null)
    {
        $this->title = $title;
        $this->body = $body;
//        $this->to = $to;
        $this->user_id = $user_id;
//        $this->request_id = $request_id;
        $this->url = url()->to('/');
//        $this->url = ($request_id)?route('manage_request',encryption($this->request_id)):route('notifications');
    }

    public function __invoke()
    {
        try {
            $user = User::find($this->user_id);
            if ($user){
                $data = [
                    "registration_ids" => [$user->device_token],
                    "notification" => [
                        "title" => $this->title,
                        "body" => $this->body,
                        "url" => $this->url,
                        "icon" => asset($user->image),
                    ]
                ];
                $dataString = json_encode($data);
                $headers = [
                    'Authorization: key=' . self::SERVER_API_KEY,
                    'Content-Type: application/json',
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                $response = curl_exec($ch);
                $log = [
                    'URI' => request()->getUri(),
                    'METHOD' => request()->getMethod(),
                    'REQUEST_BODY' => request()->all(),
                    'RESPONSE' => $response,
                    'title' => $this->title
                ];
                Log::debug('notification success test', $log);
                return $response;
            }



        } catch (\Exception $e) {
            $log = [
                'URI' => request()->getUri(),
                'METHOD' => request()->getMethod(),
                'REQUEST_BODY' => request()->all(),
                'RESPONSE' => $e->getMessage()
            ];
            Log::debug('notification failed test', $log);
//            echo 'Message: ' .$e->getMessage();
        }


    }
}

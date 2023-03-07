<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
public $token="EAASatyWhhnIBAL8PL5S3fVouaCPbBtFDiNxLVFmxFjX6RhmyI5CodhJBju6FhVjCd8JgNP8zEybMRx8pPPP6TZCzBWDYmZAwbeVjuE4QyFWfO1RglB4DLpeGP3ONr23ROkKYk9qMEsJoZAmKZBKZA6zZCiJBJj7FZBa5ZB85oKAZAvN4fr9SZAIEdvkNX34GZAr0FNkO0ynuFDFxQZDZD";
    public function uploadImage($file, $dir,$copy=false)
    {
        $quality=50;
        //$file = $request->file('image');
        if ($copy) {
            try {
                $path =$file;
            $filenames = basename($path);
            $extension=explode('.',$filenames);
            $filename = "nsn".uniqid(). time() . '.' . $extension[1];
              $file->storeAs('uploads/',$filename,'s3');
           return $filename;
            } catch (\Throwable $th) {
                return null;
            }
        }
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid(). time() . '.' . $extension;
        // $img=Image::make($file);
        if (config()['app']['env']=='local') {
          $img=Image::make($file);
          $img->save("uploads/{$dir}$filename",$quality);
        }else{
          $file->storeAs('uploads/',$filename,'s3');

        }
     return $filename;

    }

    public function deleteImage($path)
    {
        return File::delete($path);
    }

    public function getUserByApiToken($request)
    {
        $api_token = $request->header()['authorization'][0];
        $token=substr($api_token,7);
        $user = User::where('api_token', $token)->first();
        if ($user) {
            return $user;
        }else{
            dd('invalid token');
        }
     
    }






    protected function success_response(  $message = null,$data=null, int $code = 200)
	{
		return response()->json([
			'status' => 'success',
			'message' => $message,
			'data' => $data
		], $code);
	}

	
	protected function error_response($message = null,$data=null, int $code)
	{
		return response()->json([
			'status' => 'error',
			'message' => $message,
			'data' => $data
		], $code);
	}


public function whatsapp_verification($phone,$otp){
    $curl = curl_init();
    // booking_confirmation
    // booking_cancellation
    // otp_verification

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://graph.facebook.com/v14.0/112673221718066/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "messaging_product": "whatsapp",
    "to": "'.$phone.'",
    "type": "template",
    "template": {
        "name": "otp_verification",
        "language": {
            "code": "en_US"
        },
        "components": [
			{
			  "type": "body",
			  "parameters": [
				{
				  "type": "text",
				  "text":"'.$otp.'"
				},
			  ]
			},
		
			]
        
    }
}',

  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $this->token",
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
return $response;
}

public function whatsapp_booking($phone,$name,$id,$data,$map=null){
    $curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://graph.facebook.com/v14.0/112673221718066/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{


    "messaging_product": "whatsapp",
    "to": "'.$phone.'",
    "type": "template",
    "template": {
        "name": "booking_confirmation",
        "language": {
            "code": "en_US"
        },
        "components": [
			{
			  "type": "body",
			  "parameters": [
				{
				  "type": "text",
				  "text":"'.$name.'"
				},

                {
                    "type": "text",
                    "text":"'.$id.'"
                  },


                  {
                    "type": "text",
                    "text":"'.$data.'"
                  },

              
				
			  ]
			},
		
			]
        
    }
}',

  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $this->token ",
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
return $response;
}





public function whatsapp_cancel($phone,$name){
  $curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://graph.facebook.com/v14.0/112673221718066/messages',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS =>'{


  "messaging_product": "whatsapp",
  "to": "'.$phone.'",
  "type": "template",
  "template": {
      "name": "cancellation_booking",
      "language": {
          "code": "en_US"
      },
      "components": [
    {
      "type": "body",
      "parameters": [
      {
        "type": "text",
        "text":"'.$name.'"
      },
      ]
    },
  
    ]
      
  }
}',

CURLOPT_HTTPHEADER => array(
 "Authorization: Bearer $this->token ",
  'Content-Type: application/json'
),
));

$response = curl_exec($curl);
curl_close($curl);
}




public function whatsapp_review($phone,$name){
  $curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://graph.facebook.com/v14.0/112673221718066/messages',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS =>'{


  "messaging_product": "whatsapp",
  "to": "'.$phone.'",
  "type": "template",
  "template": {
      "name": "review_nsn",
      "language": {
          "code": "en_US"
      },
      "components": [
    {
      "type": "body",
      "parameters": [
      {
        "type": "text",
        "text":"'.$name.'"
      },
      ]
    },
  
    ]
      
  }
}',

CURLOPT_HTTPHEADER => array(
 "Authorization: Bearer $this->token ",
  'Content-Type: application/json'
),
));

$response = curl_exec($curl);
curl_close($curl);

}



public function whatsapp_checkin($phone){
  $curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://graph.facebook.com/v14.0/112673221718066/messages',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS =>'{


  "messaging_product": "whatsapp",
  "to": "'.$phone.'",
  "type": "template",
  "template": {
      "name": "checkin",
      "language": {
          "code": "en_US"
      },
        
  }
}',

CURLOPT_HTTPHEADER => array(
 "Authorization: Bearer $this->token ",
  'Content-Type: application/json'
),
));

$response = curl_exec($curl);
curl_close($curl);

}


}

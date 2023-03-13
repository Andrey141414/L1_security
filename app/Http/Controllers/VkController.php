<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use VK\OAuth\VKOAuth;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Http;
class VkController extends Controller
{
    protected $accsessToken = 'vk1.a.aNe5FMB4a5POLg5d-SWqIAQaH8bE5v_KPGBplC7aFApSs6QB4jfjSViObY1kHm0-irQDYOFfgEqyAqcIgON2f5RAIaQJBgNIJEZnMZEG9WvzqOEI0Hk8lHOw5vhuTtLdrfIJ9vLKz8ncrvdetGOqNknDT1AYq-6aLLq8IZ_hUzja2dKUpyOvuAxWmJFaAHk2XKtAlXjJpVw__VSL6dsJcQ';

    public function handle(Request $response)
    {
        $accsessToken = $this->accsessToken;
        $group_id = $response->get('group_id');
        $response = Http::get("https://api.vk.com/method/groups.getMembers?v=5.131
        &group_id=$group_id
        &access_token=$accsessToken
        &fields=contacts");

        $result = array();
        $items = json_decode($response,true)['response']['items'];
        $i = 0;
        foreach($items as $item)
        {
            $response = Http::get("https://api.vk.com/method/users.get?v=5.131
            &user_id=".$item['id'].
            "&access_token=$accsessToken
            &fields=contacts");

            $user = json_decode($response,true)['response'][0];
            if(key_exists('mobile_phone',$user) && $user['mobile_phone'] != "")
            {
                $FIO = $user['first_name']." ". $user['last_name'];
                $result[] =  [
                    'name'=>$FIO,
                    'phone'=> $user['mobile_phone']
                ];
            }
            if(++$i == 100)
            {
                break;
            }

            
        }

        return ($result) ;
    }
    //
    //$oauth = new \VK\OAuth\VKOAuth();
    
}
//https://api.vk.com/method/groups.getMembers?v=5.131&group_id=sciencemem&access_token=vk1.a.X4bfQzUlAffFBrteEodaIFSkA4jlW3uy0nuaaw5hA0gm8QDPIuWQXyTR6yayFZIuzGHocS8peAho1q5v-Kd9T-0pjAOp3t8Wg5jSDz62Z7uxa-fk7WWSG5RZGQK8ybpOmBoGCjqcuffR2EarY2n7T8h6XSjYOVFxeA3z-iFoAhGcsWq9apZS08MlNXgHEwLUVzWOkuKCQ100Wa7_8jGnOA&offset=600&fields=contacts
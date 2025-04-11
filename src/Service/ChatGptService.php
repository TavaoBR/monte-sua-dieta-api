<?php 

namespace App\Service;

class ChatGptService 
{
    public function gerar(string $input)
    {
       $data = [
         'model' => 'gpt-4o-mini',
         'stores' => true,
         'messages' => [
            ['role' => 'user', 'content' => $input]
         ]
       ];


       $ch = curl_init($_ENV['OPENAI_URL']);

       curl_setopt_array($ch, [
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_POST => true,
         CURLOPT_HTTPHEADER => [
           'Content-Type: application/json',
           'Authorization: ' . 'Bearer ' . $_ENV['OPENAI_API_KEY']
         ],
         CURLOPT_POSTFIELDS => json_encode($data)
       ]);

       $response = curl_exec($ch);

       if(curl_errno($ch)){
         curl_close($ch);
         return null;
       }

       curl_close($ch);

       $result = json_decode($response, true);

       return $result;
    }
}

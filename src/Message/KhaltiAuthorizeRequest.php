<?php

namespace Pasls\OmnipayKhalti\Message;

use GuzzleHttp\Client;
use Omnipay\Common\Message\ResponseInterface;

class KhaltiAuthorizeRequest extends AbstractKhaltiRequest
{
    public function getData()
    {
        $this->validate('amount', 'returnUrl');

        $data = array();
        $data['amount'] = $this->getAmountInteger(); // in paisa
        $data['purchase_order_id'] = $this->getTransactionId();
        $data['purchase_order_name'] = "N/A";
        $data['return_url'] = $this->getReturnUrl();
        $data['website_url'] = $this->getReturnUrl();
        return $data;
    }

    public function sendData($data)
    {
        $client = new Client();
        $response = $client->post($this->getEndpoint(),[
            'json' => $data,
            'headers' => [
                'Authorization' => "Key ".$this->getSecretKey()
            ]
        ]);
        $raw = $response->getBody()->getContents();

        $json = json_decode($raw, true);
        return $this->response = new KhaltiAuthorizeResponse($this, $json);
    }

}
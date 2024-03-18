<?php
namespace Pasls\OmnipayKhalti\Message;

use GuzzleHttp\Exception\RequestException;

class KhaltiCompletePurchaseRequest extends AbstractKhaltiRequest
{
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [
            'pidx' => $this->getParameter('pidx'),
            'amount'   =>  $this->getAmountInteger()
        ];
    }

    private function verifyPayment($data)
    {
        $payload = [
            'pidx'   =>  $data['pidx'],
        ];

        try{
            $response = $this->httpClient->request(
                'POST',
                $this->getVerifyEndpoint(),
                [
                    'Authorization'=> 'Key '.$this->getSecretKey(),
                    'Content-Type' => 'application/json'
                ],
                json_encode($payload)
            );

            $response = json_decode($response->getBody(), true);

            return $response;

        }catch(RequestException $e)
        {
            if ($e->hasResponse()) {
                return (string) $e->getResponse();
            }else{
                return $e->getMessage();
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $response =  $this->verifyPayment($data);

        return $this->response = new KhaltiCompletePurchaseResponse($this, [
            'response'  => $response,
            'data'      =>  $data
        ]);
    }

}
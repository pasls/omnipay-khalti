<?php
namespace Pasls\OmnipayKhalti\Message;

use Omnipay\Common\Message\AbstractRequest;

abstract class AbstractKhaltiRequest extends AbstractRequest
{
    private $testVerifyEndpoint = 'https://a.khalti.com/api/v2/epayment/lookup/';
    private $liveVerifyEndpoint = 'https://khalti.com/api/v2/epayment/lookup/';
    private $testEndpoint = 'https://a.khalti.com/api/v2/epayment/initiate/';
    private $liveEndpoint = 'https://khalti.com/api/v2/epayment/initiate/';

    public function getSecretKey()
    {
        return $this->getParameter('secret_key');
    }

    public function setSecretKey($secretKey)
    {
        $this->setParameter("secret_key", $secretKey);
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getVerifyEndpoint()
    {
        return $this->getTestMode() ? $this->testVerifyEndpoint: $this->liveVerifyEndpoint;
    }
}
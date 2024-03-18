<?php

namespace Pasls\OmnipayKhalti;

use Omnipay\Common\AbstractGateway;

class KhaltiGateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "Khalti";
    }

    public function getSecretKey()
    {
        return $this->getParameter('secret_key');
    }

    public function setSecretKey($secretKey)
    {
        $this->setParameter("secret_key", $secretKey);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Pasls\OmnipayKhalti\Message\KhaltiAuthorizeRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Pasls\OmnipayKhalti\Message\KhaltiAuthorizeRequest', $parameters);
    }

    public function verify($data)
    {
        return $this->createRequest('\Pasls\OmnipayKhalti\Message\KhaltiCompletePurchaseRequest', $data)->send();
    }

    public function completePurchase($data)
    {
        return $this->createRequest('\Pasls\OmnipayKhalti\Message\KhaltiCompletePurchaseRequest', $data);
    }
}
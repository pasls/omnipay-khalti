<?php

namespace Pasls\OmnipayKhalti\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class KhaltiAuthorizeResponse extends AbstractResponse implements  RedirectResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->getData()['payment_url'];
    }
    public function getRedirectMethod()
    {
        return 'GET';
    }

}
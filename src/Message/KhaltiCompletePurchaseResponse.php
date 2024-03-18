<?php
namespace Pasls\OmnipayKhalti\Message;

use Omnipay\Common\Message\AbstractResponse;

class KhaltiCompletePurchaseResponse extends AbstractResponse
{
    /**
     * @{@inheritdoc}
     */
    public function isSuccessful()
    {
        $pidx = $this->data['response']['pidx'] ?? null;
        $responseAmount = $this->data['response']['total_amount'] ?? null;
        $status = $this->data['response']['status'] ?? null;
        if($pidx && $responseAmount == $this->data['data']['amount'] && $status == 'Completed') {
            return true;
        }

        return false;
    }
    /**
     * @{@inheritdoc}
     */
    public function getTransactionReference()
    {
        return $this->data['response']['transaction_id'];
    }

    public function getPurchaseRequest()
    {
        return $this->data['data'];
    }

    public function getPurchaseResponse()
    {
        return $this->data['response'];
    }
} 
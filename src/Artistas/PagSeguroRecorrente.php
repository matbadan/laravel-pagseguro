<?php


namespace Artistas\PagSeguro;

class PagSeguroRecorrente extends PagSeguroClient
{

    private $preApproval = [];

    /**
     * Define os dados do plano.
     *
     * @param array $preApproval
     *
     * @return $this
     */

    public function setPreApproval(array $preApproval){

        $preApproval = [
            'preApprovalName'     => $this->sanitize($preApproval, 'preApprovalName'),
            'preApprovalCharge' => $this->sanitize($preApproval, 'preApprovalCharge'),
            'preApprovalPeriod'    => $this->sanitize($preApproval, 'preApprovalPeriod'),
            'preApprovalCancelUrl'    => $this->sanitize($preApproval, 'preApprovalCancelUrl'),
            'preApprovalAmountPerPayment'    => $this->sanitize($preApproval, 'preApprovalAmountPerPayment'),
            'preApprovalMembershipFee'    => $this->sanitize($preApproval, 'preApprovalMembershipFee'),
            'preApprovalTrialPeriodDuration'    => $this->sanitize($preApproval, 'preApprovalTrialPeriodDuration'),
            'preApprovalExpirationValue'    => $this->sanitize($preApproval, 'preApprovalExpirationValue'),
            'preApprovalExpirationUnit'    => $this->sanitize($preApproval, 'preApprovalExpirationUnit'),
            'maxUses'    => $this->sanitize($preApproval, 'maxUses')
        ];

        $this->preApproval = $preApproval;
        Log::info($this->preApproval);
        return $this->sendPreApproval($this->preApproval);
    }



    function sendPreApproval($params){

        $sandbox = $this->sandbox ? 'sandbox.' : '';

        //$url = 'https://ws.'.$sandbox.'pagseguro.uol.com.br/pre-approvals/request?email='.$this->email.'&token='.$this->token;

        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/pre-approvals/request?email='.$this->email.'&token='.$this->token;


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['application/vnd.pagseguro.com.br.v3+xml;charset=ISO-8859-1']);
        if ($params !== null) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, 'utf-8');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, !$this->sandbox);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;

    }




}
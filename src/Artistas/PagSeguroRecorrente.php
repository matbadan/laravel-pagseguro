<?php


namespace Artistas\PagSeguro;

use Log;

class PagSeguroRecorrente extends PagSeguroClient
{

    /**
     * Define os dados do plano.
     *
     * @param array $preApproval
     *
     * @return $this
     */

    public function setPreApprovalRequest(array $preApproval){

        $preApproval = [
            'email' => $this->email,
            'token' => $this->token,
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

        return $this->sendTransaction($this->preApproval, $this->url['request']);
    }


    /**
     * Cria um pagamento recorrente.
     *
     * @param $dados
     *
     * @return $this
     */


    public function sendPreApproval($dados){

        $array = [
            'plan'=>$dados['plan'],
            'reference'=>$dados['reference'],
            'sender'=>[
            'name'=>$dados['senderName'],
            'email'=>$dados['senderEmail'],
            'ip'=>$dados['senderIp'],
            'hash'=>$dados['senderHash'],
            'phone'=>[
            'areaCode'=>$dados['senderPhoneArea'],
            'number'=>$dados['senderPhoneNumber'],
        ],
            'address'=>[
            'street'=>$dados['senderStreet'],
            'number'=>$dados['senderNumber'],
            'complement'=>$dados['senderComplement'],
            'district'=>$dados['senderDistrict'],
            'city'=>$dados['senderCity'],
            'state'=>$dados['senderState'],
            'country'=>$dados['senderCountry'],
            'postalCode'=>$dados['senderPostalCode'],
        ],
            'documents'=>[
            [
            'type'=>$dados['senderDocumentType'],
            'value'=>$dados['senderDocumentValue'],

        ]
        ]
        ],
            'paymentMethod'=>[
            'type'=>$dados['paymentType'],
            'creditCard'=>[
            'token'=>$dados['creditCardToken'],
            'holder'=>[
            'name'=>$dados['creditCardHolderName'],
            'birthDate'=>$dados['creditCardHolderBirthDate'],
            'documents'=>[
            [
            'type'=>$dados['creditCardHolderDocumentType'],
            'value'=>$dados['creditCardHolderDocumentValue'],
        ]
        ],
            'phone'=>[
            'areaCode'=>$dados['creditCardHolderPhoneArea'],
            'number'=>$dados['creditCardHolderPhoneNumber'],
        ],
        ]
        ]
        ]
        ];
        
        return $this->sendJsonTransaction($array, $this->url['pre-approval']);

    }


}
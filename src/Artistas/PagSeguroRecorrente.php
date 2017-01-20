<?php


namespace Artistas\PagSeguro;

use Log;

class PagSeguroRecorrente extends PagSeguroClient
{

    private $preApproval = [];
    private $directPreApproval = [];
    private $directPreApprovalSenderInfo = [];
    private $directPreApprovalSenderPhone = [];
    private $directPreApprovalSenderAddress = [];
    private $directPreApprovalCreditCard = [];
    private $directPreApprovalCreditCardHolder = [];

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


    public function sendPreApproval(array $preApproval){
        
        $array = [
            'plan' => $this->sanitize($preApproval, 'plan'),
            'reference' => $this->sanitize($preApproval, 'reference'),
            'sender' => [
            "name" =>  $this->sanitize($preApproval, 'senderName'),
            "email" => $this->sanitize($preApproval, 'senderEmail'),
            "ip" => $this->sanitize($preApproval, 'senderIp'),
            "hash" => $this->sanitize($preApproval, 'senderHash'),
            'phone' => [
            "areaCode" => $this->sanitize($preApproval, 'phoneArea'),
            "number" => $this->sanitize($preApproval, 'phoneNumber'),
        ],
            'address' => [
            "street" => $this->sanitize($preApproval, 'senderStreet'),
            "number" => $this->sanitize($preApproval, 'senderNumber'),
            "complement" => $this->sanitize($preApproval, 'senderComplement'),
            "district" => $this->sanitize($preApproval, 'senderDistrict'),
            "city" => $this->sanitize($preApproval, 'senderCity'),
            "state" => $this->sanitize($preApproval, 'senderState'),
            "country" => $this->sanitize($preApproval, 'senderCountry'),,
            "postalCode" => $this->sanitize($preApproval, 'senderPostalCode'),
        ],
            'documents' => [
            [
            "type" => $this->sanitize($preApproval, 'senderDocumentType'),
            "value" => $this->sanitize($preApproval, 'senderDocumentValue'),
        ]
        ]
        ],
            'paymentMethod' => [
            "type" => $this->sanitize($preApproval, 'paymentType'),
            'creditCard' => [
            'token' => $this->sanitize($preApproval, 'creditCardToken'),
            'holder' => [
            "name" => $this->sanitize($preApproval, 'creditCardHolderName'),
            "birthDate" => $this->sanitize($preApproval, 'creditCardHolderBirthDate'),          
            'documents' => [
            [
            "type" => $this->sanitize($preApproval, 'creditCardHolderDocumentType'),
            "value" => $this->sanitize($preApproval, 'creditCardHolderDocumentValue'),
        ]
        ],
            'phone' => [
            "areaCode" => $this->sanitize($preApproval, 'creditCardHolderPhoneArea'),
            "number" => $this->sanitize($preApproval, 'creditCardHolderPhoneNumber'),
        ],
            'billingAddress' => [
            "street" => $this->sanitize($preApproval, 'billingStreet'),
            "number" => $this->sanitize($preApproval, 'billingNumber'),
            "complement" => $this->sanitize($preApproval, 'billingComplement'),
            "district" => $this->sanitize($preApproval, 'billingDistrict'),
            "city" => $this->sanitize($preApproval, 'billingCity'),
            "state" => $this->sanitize($preApproval, 'billingState'),
            "country" => $this->sanitize($preApproval, 'billingCountry'),
            "postalCode" => $this->sanitize($preApproval, 'billingPostalCode'),
        ],
        ]
        ]
        ]
        ];

        return $this->sendJsonTransaction($array, $this->url['pre-approval']);

    }


}
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

 /*   public function setDirectPreApproval(array $directPreApproval){

        $directPreApproval = [
            'plan'=>$this->sanitize($directPreApproval, 'plan'),
            'reference'=>$this->sanitize($directPreApproval, 'reference')
        ];

        $this->directPreApproval = $directPreApproval;

        return $this;

    }

    public function setDirectPreApprovalSenderInfo(array $directPreApprovalSenderInfo){

        $directPreApprovalSenderInfo = [
            'name'=>$this->sanitize($directPreApprovalSenderInfo, 'name'), 
            'email'=>$this->sanitize($directPreApprovalSenderInfo, 'email'),  
            'ip'=>$this->sanitize($directPreApprovalSenderInfo, 'ip'),  
            'hash'=>$this->sanitize($directPreApprovalSenderInfo, 'hash'),  
        ];

        $this->directPreApprovalSenderInfo = $directPreApprovalSenderInfo;

        return $this;

    }

    public function setDirectPreApprovalSenderPhone(array $directPreApprovalSenderPhone){

        $phone = $this->sanitize($directPreApprovalSenderPhone, 'phone');

        $directApprovalSenderPhone = [
            'area'=>  substr($phone, 0, 2),
            'number'=> substr($phone, 2),
        ];

        $this->directPreApprovalSenderPhone = $directApprovalSenderPhone;

        return $this;
    }

    public function setDirectPreApprovalSenderAddress(array $directPreApprovalSenderAddress){


        $preApprovalSenderAddress = [
            'number'=>$this->sanitize($directPreApprovalSenderAddress, 'number'),
            'street'=>$this->sanitize($directPreApprovalSenderAddress, 'street'),
            'complement'=>$this->sanitize($directPreApprovalSenderAddress, 'complement'),
            'district'=>$this->sanitize($directPreApprovalSenderAddress, 'district'),
            'city'=>$this->sanitize($directPreApprovalSenderAddress, 'city'),
            'state'=>$this->sanitize($directPreApprovalSenderAddress, 'state'),
            'country'=>$this->sanitize($directPreApprovalSenderAddress, 'country'),
            'postalCode'=>$this->sanitize($directPreApprovalSenderAddress, 'postalCode'),
        ];

        $this->directPreApprovalSenderAddress = $preApprovalSenderAddress;

        return $this;
    }

    public function setDirectPreApprovalCreditCard(array $directPreApprovalCreditCard){

        $directPreApprovalCreditCard = [
            'creditCardToken'=>$this->sanitize($directPreApprovalCreditCard, 'token'),
        ];
        $this->directPreApprovalCreditCard =  $directPreApprovalCreditCard;

        return $this;

    }

    public function setDirectPreApprovalCreditCardHolder(array $directPreApprovalCreditCardHolder){

        $phone = $this->sanitizeNumber($directPreApprovalCreditCardHolder, 'phone');

        $directPreApprovalCreditCardHolder = [
             dados do titular do cartão 
            'name'=>$this->sanitize($directPreApprovalCreditCardHolder, 'name'),
            'birthDate'=>$this->sanitize($directPreApprovalCreditCardHolder, 'birthDate'),
            'documentType'=>$this->sanitize($directPreApprovalCreditCardHolder, 'documentType'),
            'documentValue'=>$this->sanitize($directPreApprovalCreditCardHolder, 'documentValue'),
            'phoneArea'=>substr($phone, 0, 2),
            'phoneNumber'=>substr($phone, 2),
        ];

        $this->directPreApprovalCreditCardHolder = $directPreApprovalCreditCardHolder;

        return $this;

    }*/

    public function send(){

        $array = [
            'plan' => 'FFAC8AE62424AC5884C90F8DAAE2F21A',
            'reference' => 'MEU-CODIGO',
            'sender' => [
            "name" => "José Comprador",
            "email" => "email@consumidor.com.br",
            "ip" => "1.1.1.1",
            "hash" => "hash",
            'phone' => [
            "areaCode" => "99",
            "number" => "99999999",
        ],
            'address' => [
            "street" => "Av. PagSeguro",
            "number" => "9999",
            "complement" => "99o andar",
            "district" => "Jardim Internet",
            "city" => "Cidade Exemplo",
            "state" => "SP",
            "country" => "BRA",
            "postalCode" => "99999999",
        ],
            'documents' => [
            [
            "type" => "CPF",
            "value" => "99999999999",
        ]
        ]
        ],
            'paymentMethod' => [
            "type" => "CREDITCARD",
            'creditCard' => [
            'token' => '4C63F1BD5A0E47220F8DB2920325499D',
            'holder' => [
            "name" => "JOSÉ COMPRADOR",
            "birthDate" => "20/12/1990",                
            'documents' => [
            [
            "type" => "CPF",
            "value" => "99999999999",
        ]
        ],
            'phone' => [
            "areaCode" => "99",
            "number" => "99999999",
        ],
            'billingAddress' => [
            "street" => "Av. PagSeguro",
            "number" => "9999",
            "complement" => "99o andar",
            "district" => "Jardim Internet",
            "city" => "Cidade Exemplo",
            "state" => "SP",
            "country" => "BRA",
            "postalCode" => "99999999",
        ],
        ]
        ]
        ]
        ];

        Log::info('pre-approval');
        return $this->sendJsonTransaction($array, $this->url['pre-approval']);

    }


}
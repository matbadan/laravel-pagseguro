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

    public function setDirectPreApproval(array $directPreApproval){

        $directPreApproval = [
            'directApprovalPlan'=>$this->sanitize($directPreApproval, 'directApprovalPlan'),
            'directApprovalReference'=>$this->sanitize($directPreApproval, 'directApprovalReference')
        ];

        $this->directPreApproval = $directPreApproval;

        return $this;

    }

    public function setDirectPreApprovalSenderInfo(array $directPreApprovalSenderInfo){

        $directPreApprovalSenderInfo = [
            'preApprovalSenderInfoName'=>$this->sanitize($directPreApprovalSenderInfo, 'preApprovalSenderInfoName'), 
            'preApprovalSenderInfoEmail'=>$this->sanitize($directPreApprovalSenderInfo, 'preApprovalSenderInfoEmail'),  
            'preApprovalSenderInfoIp'=>$this->sanitize($directPreApprovalSenderInfo, 'preApprovalSenderInfoIp'),  
            'preApprovalSenderInfoHash'=>$this->sanitize($directPreApprovalSenderInfo, 'preApprovalSenderInfoHash'),  
            'preApprovalSenderInfoDocumentType'=>$this->sanitize($directPreApprovalSenderInfo, 'preApprovalSenderInfoDocumentType'),  
            'preApprovalSenderInfoDocumentValue'=>$this->sanitize($directPreApprovalSenderInfo, 'preApprovalSenderInfoDocumentValue'),  
            'preApprovalSenderInfoPhoneArea'=>$this->sanitize($directPreApprovalSenderInfo, 'preApprovalSenderInfoPhoneArea'), 
            'preApprovalSenderInfoPhoneNumber'=>$this->sanitize($directPreApprovalSenderInfo, 'preApprovalSenderInfoPhoneNumber'),

        ];

        $this->directPreApprovalSenderInfo = $directPreApprovalSenderInfo;

        return $this;

    }

    public function setDirectPreApprovalSenderAddress(array $preApprovalSenderAddress){


        $preApprovalSenderAddress = [
            'preApprovalSenderAddressNumber'=>$this->sanitize($preApprovalSenderAddress, 'preApprovalSenderAddressNumber'),
            'preApprovalSenderAddressStreet'=>$this->sanitize($preApprovalSenderAddress, 'preApprovalSenderAddressStreet'),
            'preApprovalSenderAddressComplement'=>$this->sanitize($preApprovalSenderAddress, 'preApprovalSenderAddressComplement'),
            'preApprovalSenderAddressDistrict'=>$this->sanitize($preApprovalSenderAddress, 'preApprovalSenderAddressDistrict'),
            'preApprovalSenderAddressCity'=>$this->sanitize($preApprovalSenderAddress, 'preApprovalAddressCity'),
            'preApprovalSenderAddressState'=>$this->sanitize($preApprovalSenderAddress, 'preApprovalAddressState'),
            'preApprovalSenderAddressCountry'=>$this->sanitize($preApprovalSenderAddress, 'preApprovalSenderAddressCountry'),
            'preApprovalSenderAddressPostalCode'=>$this->sanitize($preApprovalSenderAddress, 'preApprovalSenderAddressPostalCode'),
        ];

        $this->directPreApprovalSenderAddress = $preApprovalSenderAddress;

        return $this;
    }

    public function setDirectPreApprovalCreditCard(array $directPreApprovalCreditCard){

        $directPreApprovalCreditCard = [
            'token'=>$this->sanitize($directPreApprovalCreditCard, 'token'),
        ];
        $this->directPreApprovalCreditCard =  $directPreApprovalCreditCard;

        return $this;

    }

    public function setDirectPreApprovalCreditCardHolder(array $directPreApprovalCreditCardHolder){
        
        $phone = $this->sanitizeNumber($directPreApprovalCreditCardHolder, 'phone');
        
        $directPreApprovalCreditCardHolder = [
            /* dados do titular do cartão */
            'name'=>$this->sanitize($directPreApprovalCreditCardHolder, 'name'),
            'birthDate'=>$this->sanitize($directPreApprovalCreditCardHolder, 'birthDate'),
            'documentType'=>$this->sanitize($directPreApprovalCreditCardHolder, 'documentType'),
            'documentValue'=>$this->sanitize($directPreApprovalCreditCardHolder, 'documentValue'),
            'phoneArea'=>substr($phone, 0, 2),
            'phoneNumber'=>substr($phone, 2),
        ];

        $this->preApprovaldirectPreApprovalCreditCardHolder = $directPreApprovalCreditCardHolder;

        return $this;

    }


}
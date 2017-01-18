<?php
namespace Artistas\PagSeguro;
use Log;
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
            'maxUses'    => $this->sanitize($preApproval, '&maxUses'),
        ];
        $this->preApproval = $preApproval;

        Log::info($this);

        return $this;
    }
}
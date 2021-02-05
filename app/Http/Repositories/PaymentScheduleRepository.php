<?php


namespace App\Http\Repositories;


use App\Models\PaymentSchedule;

class PaymentScheduleRepository
{
    public function getData($paginate = false , $withTrashed = false , $status = '')
    {
        return ($paginate)? $this->getPaymentSchedules('','','',$status,'', $withTrashed )
             ->paginate(config('constant.PAGINATE')) : $this->getPaymentSchedules('','','',$status,'', $withTrashed)->get();
    }

    public function getPaymentSchedules($user_id = '', $payment_head_id = '', $payment_head_name = '', $status = '', $payment_status = '', $withTrashed = false)
    {
        ($withTrashed) ? $paymentSchedules = PaymentSchedule::withTrashed()->latest() : $paymentSchedules = PaymentSchedule::query()->latest();
        $paymentSchedules->when((!empty($user_id)), function ($paymentSchedules) use ($user_id) {
            $paymentSchedules->where('user_id', $user_id);
        });
        $paymentSchedules->when((!empty($payment_head_id)), function ($paymentSchedules) use ($payment_head_id) {
            $paymentSchedules->where('payment_head_id', $payment_head_id);
        });
        $paymentSchedules->when((!empty($payment_head_name)), function ($paymentSchedules) use ($payment_head_name) {
            $this->paymentScheduleByHeadName($paymentSchedules , $payment_head_name);
        });
        $paymentSchedules->when((!empty($status)), function ($paymentSchedules) use ($status) {
            $paymentSchedules->where('status', $status);
        });
        $paymentSchedules->when((!empty($payment_status)), function ($paymentSchedules) use ($payment_status) {
            $paymentSchedules->where('payment_status', $payment_status);
        });
        return $paymentSchedules;
    }

    protected function paymentScheduleByHeadName($paymentSchedules , $payment_head_name)
    {
        $paymentSchedules->whereHas('paymentHead',function ($paymentHead) use ($payment_head_name){
                return $paymentHead->where('name', $payment_head_name);
            });
    }

}
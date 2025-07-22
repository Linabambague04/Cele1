<?php

namespace App\Services\impl;

use App\Models\Payment;
use App\Services\PaymentService;

class PaymentServiceImpl implements PaymentService
{
    public function all(){
        return Payment::included()->filter()->get();        
    }
    public function show($id){
        return Payment::with(['user', 'event'])->findOrFail($id);
    }
    public function create(array $data){
        return Payment::create($data);
    }
    public function update($id, array $data){
        $payments = Payment::find($id);
        if(!$payments) {
            return null;
        }
        $payments->update($data);
        return $payments;
    }

    public function delete($id){
        $payments = Payment::find($id);
        if(!$payments){
            return false;
        }
        return $payments->delete();
    }
}

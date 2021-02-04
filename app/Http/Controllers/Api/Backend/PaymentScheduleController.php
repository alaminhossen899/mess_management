<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PaymentScheduleRepository;
use App\Http\Resources\PaymentScheduleResource;
use Illuminate\Http\Request;

class PaymentScheduleController extends Controller
{
    public function __construct(PaymentScheduleRepository $paymentScheduleRepository)
    {
        $this->paymentScheduleRepository = $paymentScheduleRepository;
    }

    public function index(Request $request)
    {
        return ($request->ajax()) ? PaymentScheduleResource::collection($this->paymentScheduleRepository->getData(true,true)) : abort(401 , 'Bad request');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

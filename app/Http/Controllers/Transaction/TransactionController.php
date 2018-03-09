<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends ApiController
{

    public function index()
    {
        $transaction =Transaction::all();
        return $this->showAll($transaction,200);
    }


    public function show(Transaction $transaction)
    {
        return $this->showOne($transaction,200);
    }


}

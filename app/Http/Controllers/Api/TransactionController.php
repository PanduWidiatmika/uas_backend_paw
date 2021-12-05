<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Transaction;

class TransactionController extends Controller
{
    
    public function index(){
        $transaction = Transaction::all();
        if(count($transaction)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$transaction
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    public function show($id){
        $transaction = Transaction::find($id);
        if(!is_null($transaction)){
            return response([
                'message' => 'Retrieve Cource Success',
                'data' =>$transaction
            ],200);
        }
        return response([
            'message' => 'Transaction Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'tanggal' => 'required|date_format:Y-m-d|before_or_equal:today',
            'waktu' => 'required|date_format:H:i|before_or_equal:now',
            'biaya' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'note' => 'max:60'
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $transaction = Transaction::create($storeData);
        return response([
            'message' => 'Add Transaction Success',
            'data' =>$transaction
        ],200);      
    }

    public function destroy($id){
        $transaction = Transaction::find($id);
        if(is_null($transaction)){
            return response([
                'message' => 'Transaction Not Found',
                'data' => null
            ],404);
        }

        if($transaction->delete()){
            return response([
                'message' => 'Delete Transaction Success',
                'data' =>$transaction
            ],200);
        }
       
        return response([
            'message' => 'Delete Transaction Failed',
            'data' => null,
        ],400);      
    }

    public function update(Request $request,$id){
        $transaction = Transaction::find($id);
        if(is_null($transaction)){
            return response([
                'message' => 'Transaction Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'tanggal' => 'required|date_format:Y-m-d|before_or_equal:today',
            'waktu' => 'required|date_format:H:i|before_or_equal:now',
            'biaya' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'note' => 'max:60'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $transaction->tanggal = $updateData['tanggal'];
        $transaction->waktu = $updateData['waktu'];
        $transaction->biaya = $updateData['biaya'];
        $transaction->metode_pembayaran = $updateData['metode_pembayaran'];  
        $transaction->note = $updateData['note'];  
        
        if($transaction->save()){
            return response([
                'message' => 'Update Transaction Success',
                'data' => $transaction
            ],200);
        }

        return response([
            'message' => 'Update Transaction failed',
            'data' => null,
        ],400);
    }
}

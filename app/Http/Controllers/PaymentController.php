<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class PaymentController extends Controller
{
    //

    public function paymentCreate(){

        return view('admin.payment.paymentCreatePage');
    }

    public function createPayment(Request $request){

        $this->checkValidation($request, "create");

        $data = $this->getData($request);

        // $data = $request->only(['accountNumber', 'accountName', 'accountType', 'image']);

        // Payment::create($data);

        if($request->hasFile('image')){

            $filename =  uniqid() . $request->file('image')->getClientOriginalName();
          
             $request->file('image')->move(public_path() . "/paymentMethodImages/" , $filename);
            $data['account_image'] = $filename;

        }
          Payment::create($data);
        

        Alert::success('Success', 'Payment method is created successfully');

        return back();
    }

    public function paymentList(){

    //   $payments = Payment::select('account_number', 'account_name', 'account_type', 'account_image')->all();

    //   dd($payments);

       $payments = Payment::when(request('searchKey'), function($query){
                                $query->where( 'account_number', 'like', '%' .request('searchKey'). '%' )
                                      ->orWhere('account_name', 'like', '%' .request('searchKey'). '%' )
                                      ->orWhere('account_type', 'like', '%' .request('searchKey'). '%' );
                            })
                            
                            ->orderBy('created_at', 'desc')
                            ->paginate(3);


       return view('admin.payment.paymentPage', compact('payments'));

    }

    public function editPayment($id){

        $payment = Payment::where('id', $id)->first();

        return view('admin.payment.paymentEditPage', compact('payment'));

    }

    public function updatePayment(Request $request){

        //   dd($request->paymentMethodId);

          $this->checkValidation($request, "update");

          $data = $this->getData($request);

          if($request->hasFile('image')){

                $oldImage = $request->paymentMethodImage;

                  if(file_exists(public_path('/paymentMethodImages/' . $oldImage))){

                        unlink(public_path('/paymentMethodImages/' . $oldImage));

                    }
             $filename = uniqid() . $request->file('image')->getClientOriginalName();

             $request->file('image')->move(public_path() . '/paymentMethodImages/', $filename);

                $data['account_image'] = $filename;
           
          }else{

            $data['account_image'] = $request->paymentMethodImage;

          }


        

          Payment::where('id', $request->paymentMethodId)->update($data);


            Alert::success('Success', 'Payment method is updated successfully');

             return to_route('payment#list');


         
          }



    public function deletePayment($id){

        $deletePayment = Payment::find($id);
        $paymentImage = $deletePayment['account_image'];

        if(file_exists(public_path('/paymentMethodImages/'.$paymentImage))){

            unlink(public_path('/paymentMethodImages/'. $paymentImage));
        }
        Payment::destroy($id);

        Alert::success('Success', 'Payment method is deleted successfully');

        return to_route('payment#list');
    }
    
    public function getData($request){
        
     return [
       
        'account_number'=>$request->accountNumber,
         'account_name'=>$request->accountName,
        'account_type'=>$request->accountType,
        'account_image'=>$request->image,
        
     ];

    }
    private function checkValidation($request, $action)
    {

     $rules = [
         'accountNumber' => 'required|min:2|max:50|unique:payments,account_number,'.$request->id,
            'accountName' => 'required|min:2|max:100',
            'accountType' => 'required|min:2|max:100'
        

      ];

      $rules['image'] = $action == 'create' ? 'required|image|file|mimes:jpg,png,jpeg,webp,svg,avif' : 'image|file|mimes:jpg,jpeg,png,webp,svg,avif';


      $messages = [
        'accountNumber.required' => 'Account Number is required',
            'accountNumber.min' => 'Account Number must be at least 2 characters',
            'accountNumber.max' => 'Account Number must not exceed 50 characters',
            'accountNumber.unique' => 'Account Number already exists',
            'accountName.required' => 'Account Name is required',
            'accountName.min' => 'Account Name must be at least 2 characters',
            'accountName.max' => 'Account Name must not exceed 100 characters',
            'accountType.required' => 'Account Type is required',
            'accountType.min' => 'Account Type must be at least 2 characters',
            'accountType.max' => 'Account Type must not exceed 100 characters'
        
      ];

      $request->validate($rules, $messages);
       
    }
}

       
    

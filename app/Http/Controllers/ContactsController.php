<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllcontact()
    {
        $contact = ContactModel::all();
        if($contact){
            return response([
                'message'=> 'Success',
                'contact' => $contact
            ]);
        }else{
            return response([
                'message'=>'error',
                'contact' => 'no contact was found'
       ]);
 }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecontact(Request $request)
    {
        $validate = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:contacts',
                'phonenumber' => 'required|string|max:15',
            ]
        );

        $contact = ContactModel::create([
            'name'=>$request->name,
        'email'=>$request->email,
            'phonenumber'=>$request->phonenumber,
        ]);

        $contact = ContactModel::find($contact->id);
        if ($contact) {
            return response(
                [
                    'message' => 'success',
                    'contact' => $contact,
                    'status' => 200
                ]
            );
        } else {
            return response(
                [
                    'message' => 'error',
                    'product' => 'product does not exist!',
                    'status' => 404
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate(['id' => 'required']);
        $contact = ContactModel::find($request->id);
        if ($contact) {
            return response([
                'message' => 'success',
                'contact' => $contact,
                'status' => 200
            ]);
        } else {
            return response([
                'message' => 'error',
                'contact' => 'Product does not exist',
                'status' => 404
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatecontact(Request $request, ContactModel $contactModel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email,' . $contactModel->id,
            'phonenumber' => 'required|string|max:15'
        ]);
        $contact = ContactModel::find($request->id);
        if($contact){
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phonenumber = $request->phonenumber;
            $contact->save();
            return response([
                'message'=>'success',
                'products'=> $contact,
                'status'=> 200
            ]);
        }else{
            return response(
                [
                    'message' => 'error',
                    'product' => 'some thing not right',
                    'status' => 404
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletecontact(Request $request)
    {
        $request->validate(['id'=> 'required']);
        $contact = ContactModel::find($request->id);
        if($contact){
            $contact->delete();
            return response([
                'message'=>'success',
                'products'=> 'contact has been deleted successfully!',
                'status'=>200
            ]);
        }
        else{
            return response([
                'message'=> 'error',
                'products'=>'contact does not exist!',
                'status'=>404
            ]);
        }
    }
}

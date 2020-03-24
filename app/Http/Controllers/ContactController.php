<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Resources\Contact as ContactResource;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Contact::class);
        return ContactResource::collection(request()->user()->contacts);
    }

    public function store()
    {
        $this->authorize('create', Contact::class);

        $contact = request()->user()->contacts()->create($this->validateData());
        return (new ContactResource($contact))
      ->response()
      ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Contact $contact, Request $request)
    {
        //ContactPolicyのviewメソッドに対応させる
        $this->authorize('view', $contact);

        return new ContactResource($contact);
    }

    public function update(Contact $contact)
    {
        //updateを引数に渡さなくてもupdateメソッドの中でautherizeを実行すれば自動でpolicyのupdateメソッドが呼ばれる
        $this->authorize($contact);
        $contact->update($this->validateData());

        return (new ContactResource($contact))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Contact $contact)
    {
        $this->authorize($contact);
        $contact->delete();
        return response([],Response::HTTP_NO_CONTENT);
    }

    private function validateData()
    {
        return request()->validate([
        'name'=>'required',
        'email'=>'required | email',
        'birthday'=>'required',
        'company'=>'required',
      ]);
    }
}

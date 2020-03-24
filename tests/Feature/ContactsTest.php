<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Contact;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ContactsTest extends TestCase
{
    use RefreshDatabase; //自動でマイグレーションを実行

    protected $user;

    /**
     * This method is called before each test.
     */
    protected function setUp():void
    {
        parent::setUp();//親のクラスのsetUpを独自でsetUpメソッドを定義する場合はよびだす
        $this->user = factory(User::class)->create();
    }

    /**
     *@test
    */
    public function a_list_of_contacts_can_be_fetched_for_the_authenticatid_user()
    {
        $firstUser = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $firstContact = factory(Contact::class)->create(['user_id'=>$firstUser->id]);
        $secondContact = factory(Contact::class)->create(['user_id'=>$secondUser->id]);

        $response = $this->get('/api/contacts?api_token='.$secondUser->api_token);
        // dd(json_decode($response->getContent()));
        $response->assertJsonCount(1)->assertJson([
          'data'=>[
            [
            'data'=>[
              'contact_id'=>$secondContact->id,
              'email'=>$secondContact->email,
            ]
             ]
          ]
        ]);
    }

    /**
     *@test
    */
    public function an_unanthenticated_should_be_redirected_to_login()
    {
        $respone = $this->post(
            '/api/contacts',
            array_merge($this->data(), ['api_token'=>''])
        ); //postメソッドでPOSTリクエストを送る,第２引数にPOST値の配列を渡す
        $respone->assertRedirect('api/login');
        // dd($respone->message);
        $this->assertCount(0, Contact::all());
    }

    /**
     *@test
    */
    public function an_authenticated_users_can_add_a_contact()
    {
        $respone = $this->post('/api/contacts', $this->data()); //postメソッドでPOSTリクエストを送る,第２引数にPOST値の配列を渡す
        $contact = Contact::first();

        $this->assertEquals('Tanaka', $contact->name);
        $this->assertEquals('test@docomo.ne.jp', $contact->email);
        $this->assertEquals('05/08/1993', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('ABC String', $contact->company);
        $respone->assertStatus(201);
        $respone->assertJson([
         'data'=>[
           'contact_id'=>$contact->id,
           'email'=>$contact->email,
         ],
         'links'=>[
           'self'=>$contact->path(),
         ],
       ]);
    }

    /**
     *@test
    */
    public function fields_required()
    {
        collect(['name','email','birthday','company'])
       ->each(function ($field) {
           $respone = $this->post(
               '/api/contacts',
               array_merge($this->data(), [$field=>''])
           );
           $respone->assertSessionHasErrors($field);
           $this->assertCount(0, Contact::all());
       });
    }

    /**
     *@test
    */
    public function email_must_be_a_valid_email()
    {
        $respone = $this->post(
            '/api/contacts',
            array_merge($this->data(), ['email'=>'ABC'])
        );
        $respone->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }

    /**
     *@test
    */
    public function birthday_must_be_a_valid_birthday()
    {
        $this->withoutExceptionHandling();
        $respone = $this->post('/api/contacts', $this->data());
        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('1993年5月08日', Contact::first()->birthday->format('Y年n月d日')); //nは１桁のときに先頭に0を付けない
        $this->assertEquals('1993-5-08', Contact::first()->birthday->format('Y-n-d'));
    }

    /**
     *@test
    */
    public function a_contact_can_be_retrieved()
    {
        $contact = factory(Contact::class)->create(['user_id'=>$this->user->id]);
        $respone = $this->get('/api/contacts/'.$contact->id.'?api_token='.$this->user->api_token);
        $respone->assertJson([
          'data'=>[
          'contact_id'=>$contact->id,
          'name'=>$contact->name,
          'email'=>$contact->email,
          'birthday'=>$contact->birthday->format('Y/n/d'),
          'company'=>$contact->company,
          'last_updated'=>$contact->updated_at->diffForHumans(),
        ],
        ]);
    }

    /**
     *@test
    */
    public function only_the_user_contacts_can_be_retrieved()
    {
        $contact = factory(Contact::class)->create(['user_id'=>$this->user->id]);

        $anotherUser = factory(User::class)->create();

        $response = $this->get('/api/contacts/'.$contact->id.'?api_token='.$anotherUser->api_token);
        $response->assertStatus(403);
    }

    /**
     *@test
    */
    public function only_the_owener_of_the_contacts_can_be_patched()
    {
        $contact = factory(Contact::class)->create();
        $anotherUser = factory(User::class)->create();
        $response = $this->patch('/api/contacts/'.$contact->id, array_merge(
            $this->data(),
            ['api_token'=>$anotherUser->api_token]
        ));
        $response->assertStatus(403);
    }


    /**
     *@test
    */
    public function a_contact_can_be_patched()
    {
        $contact = factory(Contact::class)->create(['user_id'=>$this->user->id]);
        $respone = $this->patch('/api/contacts/'.$contact->id, $this->data());
        $contact=$contact->fresh();
        $this->assertEquals('Tanaka', $contact->name);
        $this->assertEquals('test@docomo.ne.jp', $contact->email);
        $this->assertEquals('05/08/1993', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('ABC String', $contact->company);
        $respone->assertStatus(Response::HTTP_OK);
        $respone->assertJson([
          'data'=>[
            'contact_id'=>$contact->id,
          ],
          'links'=>[
            'self'=>$contact->path(),
          ]
        ]);
    }

    /**
     *@test
    */
    public function a_contact_can_be_deleted()
    {
        $contact = factory(Contact::class)->create(['user_id'=>$this->user->id]);
        $response =$this->delete(
            '/api/contacts/'.$contact->id,
            ['api_token'=>$this->user->api_token]
        );
        $this->assertCount(0, Contact::all());
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     *@test
    */
    public function only_the_owner_can_delete_contact()
    {
        $contact = factory(Contact::class)->create();
        $anotherUser = factory(User::class)->create();
        $response =$this->delete('/api/contacts/'.$contact->id, ['api_token'=>$anotherUser->api_token]);
        $response->assertStatus(403);
    }


    private function data()
    {
        return [
         'name'=>'Tanaka',
         'email'=>'test@docomo.ne.jp',
         'birthday'=>'05/08/1993',
         'company'=>'ABC String',
         'api_token'=>$this->user->api_token,
       ];
    }
}

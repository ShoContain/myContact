<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Admin;
use App\Message;
use App\Contact;
use App\Comments;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class)->create([
          'name'=>'田中 翔太','email'=>'perblue.666@gmail.com','password'=>bcrypt('Sho00128'),
        ]);
        //他のユーザーを追加
        factory(App\User::class,9)->create();

        //作成したユーザーにメッセージを登録する
        App\User::all()->each(function($user){
          factory(App\Message::class,$user->id%4)->create([
            'user_id'=>$user->id]);
        });

        //アドミンを追加
        factory(App\Admin::class)->create(
          ['username'=>'Tanaka','password'=>bcrypt('tanaka')],
        );

        App\Message::all()->each(function($message){
          factory(App\Comments::class,$message->id%4)->create([
            'message_id'=>$message->id]);
        });

        App\User::all()->each(function($user){
          factory(App\Contact::class,$user->id%3)->create([
            'user_id'=>$user->id]);
        });

  }
}

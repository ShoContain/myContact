@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
      <svg class="fill-current text-white w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M3.9 4.2c-.5 0-.8.3-.8.8s.4.8.8.8c.5 0 .8-.4.8-.8.1-.5-.3-.8-.8-.8zM3.3 18.6c0 1.4-.2 2.1-1.5 2.1-.3 0-.7 0-.9-.1l-.3 1.1c.3.1.7.2 1.1.2 1.9 0 2.7-1.2 2.7-3.2V8.1H3.3v10.5zM9.4 17.5c1.4 0 2.3-.4 3-1.2.8-1 1.1-2.1 1.1-3.8 0-1.4-.2-2.7-1-3.5-.6-.7-1.5-1.1-2.9-1.1s-2.3.4-3 1.2c-.8 1-1.1 2.2-1.1 3.8 0 1.5.2 2.6 1 3.5.6.7 1.5 1.1 2.9 1.1zM7.5 9.7c.3-.4.9-.8 2-.8 1 0 1.6.3 1.9.7.5.6.7 1.7.7 2.9s-.2 2.4-.7 3.1c-.3.4-.9.8-2 .8-1 0-1.6-.3-1.9-.7-.5-.6-.7-1.6-.7-2.9 0-1.2.2-2.4.7-3.1zM15 14.4c0 2.1.4 3.1 2.5 3.1.6 0 1.3-.1 1.8-.2l-.1-1c-.5.1-1 .2-1.5.2-1.4 0-1.5-.6-1.5-2.1v-5h3V8.3h-3v-3l-1.2.2v2.7h-1.8v1.1H15v5.1zM6 18h17v1H6z"/>
      </svg>
      <h1 class="text-white text-3xl pt-6">新規登録</h1>
      <h2 class="text-blue-300 text-2xl">下記をご登録下さい</h2>
                    <form method="POST" action="{{ route('register') }}" class="relative pt-8">
                        @csrf
                          <div class="relative pt-6">

                            <label for="name" class="absolute uppercase text-sm pl-2 text-gray-300 font-bold">名前</label>

                            <div>
                              <input id="name" type="text" class="w-full pt-4 pl-2 rounded bg-blue-800 focus:bg-blue-600 text-gray-200 @error('name') border border-red-600 @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="山田　太郎">
                              @error('name')
                              <span class="text-red-600 text-sm" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                            </div>
                          </div>

                              <div class="pt-4 relative">
                                <label for="email" class="absolute uppercase text-sm pl-2 text-gray-300 font-bold">メール</label>
                                <div>
                                  <input id="email" type="text" class="w-full pt-4 pl-2 rounded bg-blue-800 focus:bg-blue-600 text-gray-200 @error('email') border border-red-600 @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus　placeholder="your@email.com">
                                  @error('email')
                                  <span class="text-red-600 text-sm" role="alert"><strong>{{ $message }}</strong></span>
                                  @enderror
                                </div>
                              </div>


                              <div class="pt-4 relative">
                                <label for="password" class="absolute uppercase text-sm pl-2 text-gray-300 font-bold">パスワード</label>
                                <div>
                                  <input id="password" type="password" class="w-full pt-4 pl-2 rounded bg-blue-800 focus:bg-blue-600 text-gray-200 @error('password') border border-red-600 @enderror" name="password" value="{{ old('password') }}"  autocomplete="current-password" placeholder="Password">
                                  @error('password')
                                  <span class="text-red-600 text-sm" role="alert"><strong>{{ $message }}</strong></span>
                                  @enderror
                                </div>
                              </div>

                              <div class="pt-4 relative">
                                <label for="password-confirm" class="absolute uppercase text-sm pl-2 text-gray-300 font-bold">確認のため再度パスワードを入力してください</label>
                                <div>
                                  <input id="password-confirm" type="password" class="w-full pt-4 pl-2 rounded bg-blue-800 focus:bg-blue-600 text-gray-200" name="password_confirmation"  autocomplete="password" autofocus required>
                                </div>
                              </div>

                            <div class="pt-6">
                              <button type="submit" class="w-full rounded py-2 px-3 uppercase text-left bg-gray-400 text-blue-800 text-gray-100 font-bold">登録</button>
                            </div>

                            <div class="pt-8 flex justify-between  text-sm font-bold　text-white">
                              <a class="hover:text-blue-200" href="{{ route('password.request') }}">パスワードをお忘れでしょうか？</a>
                              <a class="hover:text-blue-200" href="{{ route('login') }}">ログイン</a>
                            </div>
                    </form>
    </div>
</div>
@endsection

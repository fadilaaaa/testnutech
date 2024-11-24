<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
</head>

<body>
    <div class="flex items-center justify-center h-screen">
        <!-- component -->
        <div class="container px-4 mx-auto">
            <div class="max-w-lg mx-auto">
                <div class="text-center mb-6">
                    <h2 class="text-3xl md:text-4xl font-extrabold">Sign in</h2>
                </div>
                @if (session('error'))
                    <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="login" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block mb-2 font-extrabold" for="">Email</label>
                        <input name="email"
                            class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-slate-200 bg-white shadow border-2 border-indigo-900 rounded"
                            type="email" placeholder="email" value="{{ @old('email', '') }}">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-extrabold" for="">Password</label>
                        <input name="password"
                            class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-slate-200 bg-white shadow border-2 border-indigo-900 rounded"
                            type="password" placeholder="**********">
                    </div>
                    <div class="flex flex-wrap -mx-4 mb-6 items-center justify-between">
                        <div class="w-full lg:w-auto px-4 mb-4 lg:mb-0">
                            <label for="">
                                <input name="remember" type="checkbox">
                                <span class="ml-1 font-extrabold">Remember me</span>
                            </label>
                        </div>
                    </div>
                    <input type="submit" value="Sign in"
                        class="inline-block w-full py-4 px-6 mb-6 text-center text-lg leading-6 text-white font-extrabold bg-indigo-800 hover:bg-indigo-900 border-3 border-indigo-900 shadow rounded transition duration-200"></input>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

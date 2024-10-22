<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
        <x-flash-message />

    <div>
        <section class="bg-gray-100 min-h-screen flex box-border justify-center items-center">
            <div class="bg-[#dfa674] rounded-2xl flex max-w-3xl p-5 items-center">
                <div class="md:w-1/2 px-8">
                    <h2 class="font-bold text-3xl text-[#002D74]">Sign Up</h2>
                    <p class="text-sm mt-4 text-[#002D74]">If you are already a member, easily log in now.</p>

                    <form action="{{ route('register.store') }}" method="POST" class="flex flex-col gap-4">
                        @csrf

                        <input class="p-2 mt-8 rounded-xl border @error('name') border-red-600 @enderror" type="text"
                            name="name" value="{{ old('name') }}" placeholder="Name">
                        @error('name')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror

                        <input class="p-2 rounded-xl border @error('email') border-red-600 @enderror" type="email"
                            name="email" value="{{ old('email') }}" placeholder="Email">
                        @error('email')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror

                        <div class="relative">
                            <input class="p-2 rounded-xl border w-full @error('password') border-red-600 @enderror"
                                type="password" name="password" placeholder="Password">
                            @error('password')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="relative">
                            <input
                                class="p-2 rounded-xl border w-full @error('password_confirmation') border-red-600 @enderror"
                                type="password" name="password_confirmation" placeholder="Password Confirmation">
                            @error('password_confirmation')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                            @if (session('error'))
                                <span class="text-xs text-red-600">{{ session('error') }}</span>
                            @endif
                        </div>

                        <button
                            class="bg-[#002D74] text-white py-2 rounded-xl hover:scale-105 duration-300 hover:bg-[#206ab1] font-medium"
                            type="submit">Submit</button>
                    </form>

                    <div class="mt-4 text-sm flex justify-between items-center container-mr">
                        <p class="mr-3 md:mr-0">If you don't have an account..</p>
                        <a href="{{ route('login') }}"
                            class="text-blue-600 font-semibold hover:text-black text-lg">Login</a>
                    </div>
                </div>
                <div class="md:block hidden w-1/2">
                    <img class="rounded-2xl max-h-[1600px]"
                        src="https://images.unsplash.com/photo-1552010099-5dc86fcfaa38?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxfHxmcmVzaHxlbnwwfDF8fHwxNzEyMTU4MDk0fDA&ixlib=rb-4.0.3&q=80&w=1080"
                        alt="login form image">
                </div>
            </div>
        </section>
    </div>

</body>

</html>

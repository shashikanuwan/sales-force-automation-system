<!-- component -->
<div class="font-sans bg-white flex flex-col w-full">
    <div>
        <div class="bg-gray-200 md:overflow-hidden">
            <div class="px-4 py-16">
                <div class="relative w-full md:max-w-2xl md:mx-auto text-center">
                    <h1 class="font-bold text-gray-700 text-xl sm:text-2xl md:text-5xl leading-tight mb-6">
                        Welcome to the Inventory Management System
                    </h1>

                    <div
                        class="hidden md:block h-40 w-40 rounded-full bg-blue-800 absolute right-0 bottom-0 -mb-64 -mr-48">

                    </div>

                    <div class="hidden md:block h-5 w-5 rounded-full bg-yellow-500 absolute top-0 right-0 -mr-40 mt-32">
                    </div>
                </div>
            </div>

            <div>
                @if (Route::has('login'))
                    @auth
                        <div class="text-3xl relative flex items-top justify-center sm:items-center py-4 sm:pt-0">
                            <a href="{{ url('/dashboard') }}"class="text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                        </div>
                    @else
                        <x-auth-card>

                            <x-slot name="logo">
                                <span class="text-4xl tex w-20 h-20 fill-current text-gray-500">Login
                                    Here</span>
                            </x-slot>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div>
                                    <x-label for="email" :value="__('Email')" />

                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-label for="password" :value="__('Password')" />

                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                        required autocomplete="current-password" />
                                </div>

                                <!-- Remember Me -->
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-3">
                                        {{ __('Log in') }}
                                    </x-button>
                                </div>
                            </form>
                        </x-auth-card>
                    @endauth
                @endif
            </div>

            <svg class="fill-current bg-gray-200 text-white hidden md:block" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1440 320">
                <path fill-opacity="1"
                    d="M0,64L120,85.3C240,107,480,149,720,149.3C960,149,1200,107,1320,85.3L1440,64L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
                </path>
            </svg>

        </div>

    </div>

    <p class="text-center p-4 text-gray-600 mt-10">Created by
        <a class="border-b text-blue-500" href="https://github.com/shashikanuwan"target="_blank">@Shashika_Nuwan
        </a>
    </p>
</div>

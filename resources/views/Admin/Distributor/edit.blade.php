<x-admin-template>

    <div class="flex mx-3 justify-center mt-6 sm:px-6 lg:px-8">
        <div>
            <div>
                <p class="mt-6 text-center text-xl font-extrabold text-gray-900">
                    Update Distributor
                </p>
            </div>

            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <x-alart class="mt-4" />

            <div>
                <form action="{{ route('distributor.update', $user) }}" method="POST" class="mt-8 space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="md:grid md:grid-cols-3 gap-6 mt-4">
                        <div class="mt-5 md:mt-2">
                            <label for="">Name <span class="text-red-500">*</span> </label>
                            <input id="name" name="name" type="text" value="{{$user->name}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">User Name <span class="text-red-500">*</span> Use (-) to separate names </label>
                            <input id="user_name" name="user_name" type="text" value="{{$user->user_name}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">NIC <span class="text-red-500">*</span></label>
                            <input id="nic" name="nic" type="text" value="{{$user->nic}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Address <span class="text-red-500">*</span></label>
                            <input id="address" name="address" value="{{$user->address}}" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Phone Number <span class="text-red-500">*</span></label>
                            <input id="phone_number" name="phone_number" type="text" value="{{$user->phone_number}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Email</label>
                            <input id="email" name="email" type="email" value="{{$user->email}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Gender</label>
                            <select name="gender" id="gender" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                                <option selected value="{{$user->gender}}">{{$user->gender}}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Select Territory <span class="text-red-500">*</span></label>
                            <select name="territory_id" id="territory_id" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                                <option selected disabled>Select Territory</option>
                                @foreach ($territories as $territory)
                                <option value="{{ $territory->id }}">
                                    {{ $territory->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Password <span class="text-red-500">*</span></label>
                            <input id="password" name="password" type="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Confirm Password <span class="text-red-500">*</span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Distributor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-admin-template>

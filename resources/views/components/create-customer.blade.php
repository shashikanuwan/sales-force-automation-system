<div class="flex mx-3 justify-center mt-6 sm:px-6 lg:px-8">
    <div>
        <div>
            <p class="mt-6 text-center text-xl font-extrabold text-gray-900">
                Register New Customer
            </p>
        </div>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <x-alart class="mt-4" />

        <div>
            <form action="{{ route('customer.store') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="md:grid md:grid-cols-3 gap-6 mt-4">
                    <div class="mt-5 md:mt-2">
                        <label for="">Name <span class="text-red-500">*</span> </label>
                        <input id="name" name="name" type="text" value="{{old('name')}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Address <span class="text-red-500">*</span></label>
                        <input id="address" name="address" value="{{old('address')}}" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Phone Number <span class="text-red-500">*</span></label>
                        <input id="phone_number" name="phone_number" type="text" value="{{old('phone_number')}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Email <span class="text-red-500">*</span></label>
                        <input id="email" name="email" type="email" value="{{old('email')}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Select distributors <span class="text-red-500">*</span></label>
                        <select name="user_id" id="user_id" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                            <option selected disabled>Select distributors</option>
                            @foreach ($distributors as $distributor)
                            <option value="{{ $distributor->id }}">
                                {{ $distributor->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

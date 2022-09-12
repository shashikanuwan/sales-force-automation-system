<div class="flex mx-3 justify-center mt-6 sm:px-6 lg:px-8">
    <div>
        <div>
            <p class="mt-6 text-center text-xl font-extrabold text-gray-900">
                Register New Line Free
            </p>
        </div>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <x-alart class="mt-4" />

        <div>
            <form class="mt-8 space-y-6" action="{{ route('line.free.store') }}" method="POST">
                @csrf
                <div class="md:grid md:grid-cols-2 gap-6 mt-4">
                    <div class="mt-5 md:mt-2">
                        <label for="">Label<span class="text-red-500">*</span></label>
                        <input id="label" name="label" type="text" value="{{old('label')}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>

                     <div class="mt-5 md:mt-2">
                        <label for="">Type <span class="text-red-500">*</span></label>
                        <select name="type" id="type" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                            <option selected disabled>Select Type</option>
                            <option value="Flat">Flat</option>
                            <option value="Multiple">Multiple</option>
                        </select>
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Select Product <span class="text-red-500">*</span></label>
                        <select name="product_id" id="product_id" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                            <option selected disabled>Select Product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Lower Limit <span class="text-red-500">*</span></label>
                        <input id="lower_limit" name="lower_limit" type="number" value="{{old('lower_limit')}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Uper Limit <span class="text-red-500">*</span></label>
                        <input id="uper_limit" name="uper_limit" type="number" value="{{old('uper_limit')}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Free Quantity <span class="text-red-500">*</span></label>
                        <input id="quantity" name="quantity" type="number" value="{{old('quantity')}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Line Free
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

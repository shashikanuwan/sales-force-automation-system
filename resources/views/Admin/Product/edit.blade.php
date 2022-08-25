<x-admin-template>

    <div class="flex mx-3 justify-center mt-6 sm:px-6 lg:px-8">
        <div>
            <div>
                <p class="mt-6 text-center text-xl font-extrabold text-gray-900">
                    Update Product
                </p>
            </div>

            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <x-alart class="mt-4" />

            <div>
                <form class="mt-8 space-y-6" action="{{ route('product.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="md:grid md:grid-cols-2 gap-6 mt-4">
                        <div class="mt-5 md:mt-2">
                            <label for="">Product Name <span class="text-red-500">*</span></label>
                            <input id="name" name="name" type="text" value="{{ $product->name }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">MRP / Maximum Retail Price <span class="text-red-500">*</span></label>
                            <input id="mrp" name="mrp" type="text" value="{{ $product->mrp }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Weight / Volume <span class="text-red-500">*</span></label>
                            <input id="weight" name="weight" type="text" value="{{ $product->weight }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Symbol <span class="text-red-500">*</span></label>
                            <select name="symbol" id="symbol" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                <option selected value="{{$product->symbol}}">{{$product->symbol}}</option>
                                <option value="g">g</option>
                                <option value="ml">ml</option>
                                <option value="kg">kg</option>
                                <option value="l">l</option>
                            </select>
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Quantity <span class="text-red-500">*</span></label>
                            <input id="quantity" name="quantity" type="text" value="{{ $product->quantity }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Distributor Price <span class="text-red-500">*</span></label>
                            <input id="distributor_price" name="distributor_price" type="text" value="{{ $product->distributor_price }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>

                        <div class="mt-5 md:mt-2">
                            <label for="">Select Category <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                                <option selected value="{{$product->category_id}}">{{$product->category->name}}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-admin-template>

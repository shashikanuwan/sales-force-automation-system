<div class="flex mx-3 justify-center mt-6 sm:px-6 lg:px-8">
    <div>
        <div>
            <p class="mt-6 text-center text-xl font-extrabold text-gray-900">
                Update Order
            </p>
        </div>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <x-alart class="mt-4" />

        <div>
            <form class="mt-8 space-y-6" action="{{ route('order.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="md:grid md:grid-cols-2 gap-6 mt-4">
                    <div class="mt-5 md:mt-2">
                        <label for="">Remark</label>
                        <input id="remark" name="remark" type="text" value="{{$order->remark}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Select (Distributor / territory) <span class="text-red-500">*</span></label>
                        <select name="user_id" id="user_id" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                            <option selected value="{{$order->user_id}}">{{$order->user->name}}</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} / {{ $user->territory->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-5 md:mt-2">
                        <label for="">Deliver Date<span class="text-red-500">*</span></label>
                        <input id="deliver_date" name="deliver_date" type="dateTime-local" value="{{$order->deliver_date}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

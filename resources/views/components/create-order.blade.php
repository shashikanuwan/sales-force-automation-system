<div>

    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <x-alart class="mt-4" />

    <section class="antialiased px-4 mt-6">
        <div class="flex flex-col justify-center h-full">
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-200">
                    <h2 class="font-semibold text-gray-800">Create Orders</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        @role('admin')
                        <form class="mt-8 space-y-6" action="{{ route('order.store') }}" method="POST">
                        @endrole

                        @role('distributor')
                        <form class="mt-8 space-y-6" action="{{ route('distributor.order.store') }}" method="POST">
                        @endrole
                        @csrf

                        <div class="md:grid md:grid-cols-3 gap-6 mt-4">
                            @role('admin')
                                <div class="mt-5 md:mt-2">
                                    <label for="">Select Customer <span class="text-red-500">*</span> </label>
                                    <select name="user_id" id="user_id"
                                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                        required>
                                        <option selected disabled>Select Distributor</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} / {{ $user->territory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endrole

                            <div class="mt-5 md:mt-2">
                                <label for="">Remark</label>
                                <input id="remark" name="remark" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                            </div>

                            <div class="mt-5 md:mt-2">
                                <label for="">Order Number <span class="text-red-500">*</span> </label>
                                <input id="number" readonly type="text" value="{{$number}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" disabled>
                            </div>

                             <div class="mt-5 md:mt-2">
                                <label for="">Deliver Date <span class="text-red-500">*</span> </label>
                                <input id="deliver_date" name="deliver_date" type="dateTime-local" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                            </div>

                        </div>

                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">ID</div>
                                        </th>

                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Select (SKU / Product) <span
                                                    class="text-red-500">*</span></div>
                                        </th>

                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Quantity <span class="text-red-500">*</span>
                                            </div>
                                        </th>

                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Delete</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y resultbody">
                                    <tr>
                                        <td class="p-2 whitespace-nowrap no">
                                            1
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <select name="product_ids[]" id="product_ids"
                                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                required>
                                                <option selected disabled>Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->sku->code }} / {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <input id="quantities" name="quantities[]" type="text"
                                                value="{{ old('quantities[]') }}"
                                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <input type="button" value="X" class="delete group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="button" value="Add" class="add group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            <input type="submit" value="Create Order" class="group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.add').click(function() {
                var n = ($('.resultbody tr').length - 0) + 1;
                var tr = '<tr><td class="no">' + n + '</td>' +
                    '<td class="p-2 whitespace-nowrap"> <select name="product_ids[]" id="product_ids" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required> <option selected disabled>Select Product</option> @foreach ($products as $product) <option value="{{ $product->id }}"> {{ $product->sku->code }} / {{ $product->name }} </option> @endforeach </select> </td>' +
                    '<td class="p-2 whitespace-nowrap"> <input id="quantities" name="quantities[]" type="text" value="{{ old('quantities[]') }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"></td>' +
                    '<td class="p-2 whitespace-nowrap"> <input type="button" value="X" class="delete group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"> </td>';
                $('.resultbody').append(tr);
            });

            $('.resultbody').delegate('.delete', 'click', function() {
                $(this).parent().parent().remove();
            });

            $('.resultbody').delegate('.obtainedmarks , .totalmarks', 'keyup', function() {
                var tr = $(this).parent().parent();
                var obtainedmarks = tr.find('.obtainedmarks').val() - 0;
                var totalmarks = tr.find('.totalmarks').val() - 0;

                var percentage = (obtainedmarks / totalmarks) * 100;
                tr.find('.percentage').val(percentage);
            });
        });
    </script>

</div>

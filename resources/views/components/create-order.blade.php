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
                        <form class="mt-8 space-y-6" action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">ID</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Remark</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Quantity <span class="text-red-500">*</span>
                                            </div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Distributor / territory <span
                                                    class="text-red-500">*</span></div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Select (SKU / Product) <span
                                                    class="text-red-500">*</span></div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Deliver Date <span
                                                    class="text-red-500">*</span></div>
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
                                            <input id="remarks" name="remarks[]" type="text"
                                                value="{{ old('remarks[]') }}"
                                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <input id="quantities" name="quantities[]" type="text"
                                                value="{{ old('quantities[]') }}"
                                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <select name="user_ids[]" id="user_ids"
                                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                required>
                                                <option selected disabled>Select Distributor</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }} / {{ $user->territory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <select name="sku_ids[]" id="sku_ids"
                                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                required>
                                                <option selected disabled>Select Product</option>
                                                @foreach ($skus as $sku)
                                                    <option value="{{ $sku->id }}">
                                                        {{ $sku->code }} / {{ $sku->product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <input id="deliver_dates" name="deliver_dates[]" type="dateTime-local"
                                                value="{{ old('deliver_dates[$i]') }}"
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
                    '<td class="p-2 whitespace-nowrap"> <input id="remarks" name="remarks[]" type="text" value="{{ old('remarks[]') }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"></td>' +
                    '<td class="p-2 whitespace-nowrap"> <input id="quantities" name="quantities[]" type="text" value="{{ old('quantities[]') }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"></td>' +
                    '<td class="p-2 whitespace-nowrap"> <select name="user_ids[]" id="user_ids" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required> <option selected disabled>Select Distributor</option> @foreach ($users as $user) <option value="{{ $user->id }}"> {{ $user->name }} / {{ $user->territory->name }} </option> @endforeach </select> </td>' +
                    '<td class="p-2 whitespace-nowrap"> <select name="sku_ids[]" id="sku_ids" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required> <option selected disabled>Select Product</option> @foreach ($skus as $sku) <option value="{{ $sku->id }}"> {{ $sku->code }} / {{ $sku->product->name }} </option> @endforeach </select> </td>' +
                    '<td class="p-2 whitespace-nowrap"> <input id="deliver_dates" name="deliver_dates[]" type="dateTime-local" value="{{ old('deliver_dates[$i]') }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"> </td>' +
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

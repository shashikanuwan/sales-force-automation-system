<div>

    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <x-alart class="mt-4" />

    <section class="antialiased px-4 mt-6">
        <div class="flex flex-col justify-center h-full">
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-200">
                    <h2 class="font-semibold text-gray-800">Create Customer Orders</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <form class="mt-8 space-y-6" action="{{ route('customer-order.store') }}" method="POST">
                        @csrf
                            <div class="md:grid md:grid-cols-3 gap-6 mt-4">
                                <div class="mt-5 md:mt-2">
                                    <label for="">Select Customer <span class="text-red-500">*</span> </label>
                                    <select name="customer_id" id="customer_id"
                                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                        required>
                                        <option selected disabled>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-5 md:mt-2">
                                    <label for="">Order Number <span class="text-red-500">*</span> </label>
                                    <input id="number" name="number" type="text" value="{{$number}}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" disabled>
                                </div>
                                <div class="mt-5 md:mt-2">
                                    <label for="">Deliver Date <span class="text-red-500">*</span> </label>
                                    <input id="deliver_date" name="deliver_date" type="dateTime-local" value="{{ old('deliver_date') }}" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                </div>
                            </div>

                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">ID</div>
                                        </th>

                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Select Product <span class="text-red-500">*</span></div>
                                        </th>

                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Product Code<span class="text-red-500">*</span></div>
                                        </th>

                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Quantity <span class="text-red-500">*</span>
                                            </div>
                                        </th>

                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Free Issue <span class="text-red-500">*</span>
                                            </div>
                                        </th>

                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold">Amount<span class="text-red-500">*</span>
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
                                            <select name="product_ids[]" onchange="getProductSku(1)" id="product_id_1" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
                                                <option selected disabled>Select Product</option>
                                                @foreach ($orders as $order)
                                                    <option value="{{ $order->sku->product->id }}">
                                                        {{ $order->sku->product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <input id="productCode_1" name="product_code" type="text" readonly class="product_code appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <input name="quantities[]" onkeyup="getFreeIssue(1)" id="quantities_1" type="number"
                                                value="{{ old('quantities_1') }}"
                                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                                {{-- onkeyup="aa()"onchange --}}
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <input id="freeIssue_1" name="freeIssue" type="text" readonly class="freeIssue appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <input id="amount_1" name="amount" type="text" readonly class="amount appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <input type="button" value="X" onclick="removeNetAmount(1)"  class="delete group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        </td>
                                        <input type="hidden" name="product_count" id="product_count" value="1">
                                    </tr>
                                </tbody>
                            </table>
                            <div class="md:grid md:grid-cols-3 gap-6 mt-4">
                                <div class="mt-5 md:mt-2">
                                    <label for="">Net Amount <span class="text-red-500">*</span> </label>
                                    <input type="text" id="netAmount" name="netAmount" readonly class="netAmount">
                                </div>
                            </div>

                            <input type="button" value="add" class="add group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            <input type="submit" value="Create Order" class="group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script type="text/javascript">
    $(function() {
        $('.add').click(function() {
            var n = ($('.resultbody tr').length - 0) + 1;
            var value = $('#product_count').val();
            $('#product_count').val(value+1);
            var tr = '<tr><td class="no">' + n + '</td>' +
                '<td class="p-2 whitespace-nowrap"> <select name="product_ids[]" id="product_id_'+ n +'" onchange="getProductSku('+ n +')" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required> <option selected disabled>Select Product</option> @foreach ($orders as $order) <option value="{{ $order->sku->product->id }}"> {{ $order->sku->product->name }} </option> @endforeach </select> </td>' +
                '<td class="p-2 whitespace-nowrap"> <input id="productCode_'+ n +'" type="text" readonly class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"></td>' +
                '<td class="p-2 whitespace-nowrap"> <input id="quantities_'+ n +'" name="quantities[]" type="number" onkeyup="getFreeIssue('+ n +')" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"></td>' +
                '<td class="p-2 whitespace-nowrap"> <input id="freeIssue_'+ n +'" name="freeIssue" type="text" readonly class="freeIssue appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"></td>' +
                '<td class="p-2 whitespace-nowrap"> <input id="amount_'+ n +'" name="amount" type="text" readonly class="amount appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"></td>' +
                '<td class="p-2 whitespace-nowrap"> <input type="button" value="X" onclick="removeNetAmount('+ n +')" class="delete group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"> </td>';
            $('.resultbody').append(tr);
        });

        $('.resultbody').delegate('.delete', 'click', function() {
            var value = $('#product_count').val();
            $('#product_count').val(value-1);
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

{{-- Product Sku --}}
<script>
    function getProductSku(index) {
        var product = $('#product_id_'+ index).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('product.sku') }}",
            data: {
                _token: "{{csrf_token()}}",
                product_id:product
            },
            success: function(productCode) {
                document.getElementById('productCode_' + index).value = productCode;
                $('#quantities_' + index).attr('readonly', false);
            }
        });
    }
</script>

{{-- FreeIssue --}}
<script>
    function getFreeIssue(index) {
        var product = $('#product_id_'+ index).val();
        var quantity =  $('#quantities_'+ index).val();

        $.ajax({
            type: 'POST',
            url: "{{ route('product.free.issue') }}",
            data: {
                _token: "{{csrf_token()}}",
                product_id:product,
                quantity:quantity
            },
            success: function(data) {
                 document.getElementById('freeIssue_' + index).value = data.freeIssue;
                 document.getElementById('amount_' + index).value = data.amount;
            }
        });
    }

</script>

{{-- add Net Amount --}}
<script>
	$(document).ready(function(){
		$(".amount").each(function() {
            $('.add').click(function() {
				calculateNetAmount();
			});
		});
	});

	function calculateNetAmount() {
		var netAmount = 0;
		$(".amount").each(function() {
			if(!isNaN(this.value) && this.value.length!=0) {
				netAmount += parseFloat(this.value);
			}
		});
        document.getElementById('netAmount').value = netAmount.toFixed(2);
	}
</script>


{{-- remove Net Amount --}}
<script>
    function removeNetAmount(index) {
        $(document).ready(function(){
            var netAmount = $('input[name="netAmount"]').val();
            var amount = $('#amount_'+ index).val();
            val = netAmount - amount;

            document.getElementById('netAmount').value = val.toFixed(2);
	    });
    }
</script>

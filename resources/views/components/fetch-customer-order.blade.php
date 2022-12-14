<section class="antialiased px-4 mt-6">
    <div class="flex flex-col justify-center h-full">
        <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-200">
                <h2 class="font-semibold text-gray-800">Customer Orders</h2>
            </header>

            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <input type="checkbox" id="option-all" onchange="checkAll(this)"> Check All
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">#</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Order Number</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Customer Name</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Order Date & Time</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Deliver Date</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Delivery Status</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Net Amount</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">View Invoice</div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-sm divide-y">

                            <button type="submit" form="form1"
                                class="submitButton bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2">
                                Generate Invoice
                            </button>

                            <form id="form1" action="{{ route('customer-order-invoice.generate') }}" method="POST">
                                @csrf
                                @forelse ($customerOrders as $customerOrder)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <input type="checkbox" name="ids[]" value="{{ $customerOrder->id }}" class="checkboxClass">
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $loop->index + 1 }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $customerOrder->number }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $customerOrder->customer->name }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">
                                                {{ $customerOrder->created_at->format('M d, Y - h:i:s A') }}
                                            </div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $customerOrder->deliver_date }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            @if ($customerOrder->status = 'pending')
                                                <div class="font-medium text-red-500">{{ $customerOrder->status }}</div>
                                            @elseif ($customerOrder->status = 'started')
                                                <div class="font-medium text-orange-500">{{ $customerOrder->status }}
                                                </div>
                                            @else
                                                <div class="font-medium text-green-500">{{ $customerOrder->status }}
                                                </div>
                                            @endif
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">
                                                <?php
                                                $total = 0;
                                                foreach ($customerOrder->customerOrderProducts as $customerOrderProduct) {
                                                    $total = $total + $customerOrderProduct->product->mrp * $customerOrderProduct->quantity;
                                                }
                                                ?>
                                                Rs.{{ $total }}
                                            </div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <a href="{{ route('customer-order.invoice', $customerOrder) }}" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                View Invoice
                                            </a>
                                        </td>

                                    </td>
                                    </tr>
                                @empty
                                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-3 rounded relative my-6 w-full shadow"
                                        role="alert">
                                        <strong class="font-bold">oops!</strong>
                                        <span class="block sm:inline">Customer order have not yet been created</span>
                                    </div>
                                @endforelse
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var checkboxes = document.querySelectorAll("input[type = 'checkbox']");

    function checkAll(myCheckbox) {
        if (myCheckbox.checked == true) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        } else {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }
</script>

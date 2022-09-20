<section class="antialiased px-4 mt-6">
    <div class="flex flex-col justify-center h-full">
        <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-200">
                <h2 class="font-semibold text-gray-800">All Orders</h2>
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
                                    <div class="font-semibold">Purchase Order Number</div>
                                </th>

                                @role('admin')
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">distributor Name</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">distributor Territory</div>
                                </th>
                                @endrole

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
                                    <div class="font-semibold">Total Amount</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Invoice</div>
                                </th>

                                @role('admin')
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Edit</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Delete</div>
                                </th>
                                @endrole
                            </tr>
                        </thead>

                        <tbody class="text-sm divide-y">

                            <button type="submit" form="form1"
                                class="submitButton bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2">
                                Generate Invoice
                            </button>

                            @role('admin')
                                <a href="{{ route('export.excel') }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded m-2">
                                    Export Excel
                                </a>
                            @endrole

                            <form id="form1" action="{{ route('generate.bulk.invoice') }}" method="POST">
                                @csrf
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <input type="checkbox" name="ids[]" value="{{ $order->id }}"
                                                class="checkboxClass">
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $loop->index + 1 }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $order->number }}</div>
                                        </td>

                                        @role('admin')
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $order->user->name }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $order->user->territory->name }}</div>
                                        </td>
                                        @endrole

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">
                                                {{ $order->created_at->format('M d, Y - h:i:s A') }}
                                            </div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $order->deliver_date }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            @if ($order->status = 'pending')
                                                <div class="font-medium text-red-500">{{ $order->status }}</div>
                                            @elseif ($order->status = 'started')
                                                <div class="font-medium text-orange-500">{{ $order->status }}</div>
                                            @else
                                                <div class="font-medium text-green-500">{{ $order->status }}</div>
                                            @endif
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">
                                                Rs. {{ $order->totalPrice }}
                                            </div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="mt-2">
                                                <a href="{{ route('invoice.index', $order) }}"
                                                    class="font-medium text-green-600">View Invoice</a>
                                            </div>
                                        </td>

                                        @role('admin')
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="mt-2">
                                                <a href="{{ route('order.edit', $order) }}"
                                                    class="font-medium text-violet-600">Edit</a>
                                            </div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="mt-2">
                                                <a href="{{ route('order.destroy', $order) }}"
                                                    class="font-medium text-red-600">Delete</a>
                                            </div>
                                        </td>
                                        @endrole
                                    </tr>
                                @empty
                                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-3 rounded relative my-6 w-full shadow"
                                        role="alert">
                                        <strong class="font-bold">oops!</strong>
                                        <span class="block sm:inline">order have not yet been created</span>
                                    </div>
                                @endforelse
                            </form>
                        </tbody>
                    </table>
                    <div>
                        {{ $orders->links() }}
                    </div>
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

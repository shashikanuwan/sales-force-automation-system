<section class="antialiased px-4 mt-6">
    <div class="flex flex-col justify-center h-full">
        <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-200">
                <h2 class="font-semibold text-gray-800">All Customer Orders</h2>
            </header>

            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold bg-gray-50">
                            <tr>
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
                            </tr>
                        </thead>

                        <tbody class="text-sm divide-y">
                            <form id="form1" action="{{ route('generate.bulk.invoice') }}" method="POST">
                                @csrf
                                @forelse ($customerOrders as $customerOrder)
                                    <tr>
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
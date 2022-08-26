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
                                    <div class="font-semibold">#</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Purchase Order Number</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Region</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Territory</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Distributor</div>
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
                                    <div class="font-semibold">Product Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Available Quantity</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Order Quantity</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Total Amount</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Invoice</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">View</div>
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
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $loop->index + 1 }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $order->number }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $order->user->territory->region->name }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $order->user->territory->name }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $order->user->name }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $order->created_at->format('M d, Y - h:i:s A') }}</div>
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
                                        <div class="font-medium">{{ $order->sku->product->name }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        @if ($order->sku->product->quantity > 0)
                                            <div class="font-medium">{{ $order->sku->product->quantity }}</div>
                                        @else
                                            <div class="font-medium text-red-500">Out of Stock</div>
                                        @endif
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $order->quantity }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">Rs.{{ $order->sku->product->mrp * $order->quantity }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div>
                                            <a href="{{ route('generate.invoice', $order) }}" class="font-medium text-violet-600">Generate Invoice</a>
                                        </div>

                                        <div class="mt-2">
                                            <a href="{{ route('invoice.index', $order) }}" class="font-medium text-violet-600">View Invoice</a>
                                        </div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <a href="{{ route('order.show', $order) }}" class="font-medium text-violet-600">View</a>
                                    </td>

                                    @role('admin')
                                    <td class="p-2 whitespace-nowrap">
                                        <a href="{{ route('order.edit', $order) }}" class="font-medium text-violet-600">Edit</a>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <form action="{{ route('order.destroy', $order) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="font-medium text-rose-600">Delete</button>
                                        </form>
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
                        </tbody>
                    </table>
                    <div class="mt-6">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

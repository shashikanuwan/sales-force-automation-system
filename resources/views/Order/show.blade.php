<x-admin-template>

    <section class="antialiased px-4 mt-6">
        <div class="flex flex-col justify-center h-full">
            <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-200">
                    <h2 class="font-semibold text-gray-800">Single Order</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold bg-gray-50">
                                <tr>
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
                                        <div class="font-semibold">Purchase Order Number</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold">Date & Time</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold">Product</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold">Quantity</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold">Total Amount</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y">
                                @forelse ($orders as $order)
                                    <tr>
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
                                            <div class="font-medium">{{ $order->number }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $order->created_at->toDayDateTimeString() }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $order->sku->product->name }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">{{ $order->quantity }}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium">Rs.{{ $order->sku->product->mrp * $order->quantity }}</div>
                                        </td>
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


</x-admin-template>

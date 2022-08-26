<section class="antialiased px-4 mt-6">
    <div class="flex flex-col justify-center h-full">
        <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-200">
                <h2 class="font-semibold text-gray-800">All Product</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Category Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Product Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">SKU Code</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">MRP / Maximum Retail Price</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Weight / Volume</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Available Quantity</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Distributor Price</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Edit</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Delete</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y">
                            @forelse ($products as $product)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $product->category->name }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $product->name }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $product->sku->code }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $product->mrp }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $product->weight }} {{ $product->symbol }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        @if ($product->quantity > 0)
                                            <div class="font-medium">{{ $product->quantity }}</div>
                                        @else
                                            <div class="font-medium text-red-500">Out of Stock</div>
                                        @endif
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $product->distributor_price }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <a href="{{ route('product.edit', $product) }}"
                                            class="font-medium text-violet-600">Edit</a>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <form action="{{ route('product.destroy', $product) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="font-medium text-rose-600">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-3 rounded relative my-6 w-full shadow"
                                    role="alert">
                                    <strong class="font-bold">oops!</strong>
                                    <span class="block sm:inline">product have not yet been created</span>
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

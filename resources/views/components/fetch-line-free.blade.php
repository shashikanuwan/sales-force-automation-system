<section class="antialiased px-4 mt-6">
    <div class="flex flex-col justify-center h-full">
        <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-200">
                <h2 class="font-semibold text-gray-800">All Line Frees</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Lable</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Type</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Product</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Lower Limit</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Uper Limit</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Free Quantity</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Delete</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y">
                            @forelse ($linefrees as $linefree)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $linefree->label }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $linefree->type }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $linefree->product->name }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $linefree->lower_limit }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $linefree->uper_limit }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $linefree->quantity }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <form action="{{ route('line.free.destroy', $linefree) }}" method="POST">
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
                                    <span class="block sm:inline">Line Free have not yet been created</span>
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

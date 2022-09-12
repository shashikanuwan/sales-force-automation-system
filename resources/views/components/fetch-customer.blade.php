<section class="antialiased px-4 mt-6">
    <div class="flex flex-col justify-center h-full">
        <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-200">
                <h2 class="font-semibold text-gray-800">All Distributors</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Code</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Address</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Phone Number</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Distributor</div>
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
                            @forelse ($customers as $customer)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $customer->name }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $customer->code }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $customer->address }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $customer->phone_number }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $customer->distributor->name }}</div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <a href="{{ route('customer.edit', $customer) }}"
                                            class="font-medium text-violet-600">Edit</a>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <form action="{{ route('customer.destroy', $customer) }}" method="POST">
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
                                    <span class="block sm:inline">Customers have not yet been created</span>
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

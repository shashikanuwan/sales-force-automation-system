<section class="antialiased px-4 mt-6">
    <div class="flex flex-col justify-center h-full">
        <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-200">
                <h2 class="font-semibold text-gray-800">All Users</h2>
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
                                    <div class="font-semibold">Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">User Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">User Role</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">NIC</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Address</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Phone Number</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Region Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Territory, Region, Zone Names</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $loop->index + 1 }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $user->name }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $user->user_name }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <p class="inline-flex px-2 text-xs font-semibold leading-5 text-indigo-800 bg-indigo-100 rounded-full">
                                            {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                                        </p>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $user->nic }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $user->address }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $user->phone_number }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="font-medium">{{ $user->gender }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        @if ($user->territory)
                                            <div class="font-medium">{{ $user->territory->name }}</div>
                                            <div class="font-medium">{{ $user->territory->region->name }}</div>
                                            <div class="font-medium">{{ $user->territory->region->zone->name }}</div>
                                        @else
                                            -
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-3 rounded relative my-6 w-full shadow"
                                    role="alert">
                                    <strong class="font-bold">oops!</strong>
                                    <span class="block sm:inline">Users have not yet been created</span>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

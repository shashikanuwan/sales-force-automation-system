@props(['errors'])

@if ($errors->any())
<div {{ $attributes }}>
    <ul class="p-4 mt-2 list-disc list-inside text-sm">
        @foreach ($errors->all() as $error)
        <div role="alert" class="mt-1 flex p-1 text-red-600 border border-b-2 rounded-lg border-current">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>

            <div class="ml-3">
                <p class="mt-1 text-sm text-red-900">{{ $error }}</p>
            </div>
        </div>
        @endforeach
    </ul>
</div>
@endif

<div class="p-6 bg-white dark:bg-zinc-800 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Manage Home Products</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label for="firstDiv" class="block text-gray-800 dark:text-white mb-1">First Div</label>
            <select id="firstDiv" wire:model="firstDiv" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white">
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="secondDiv" class="block text-gray-800 dark:text-white mb-1">Second Div</label>
            <select id="secondDiv" wire:model="secondDiv" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white">
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="thirdDiv" class="block text-gray-800 dark:text-white mb-1">Third Div</label>
            <select id="thirdDiv" wire:model="thirdDiv" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white">
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>

    <!-- Fetch Buttons -->
    <div class="mt-6 space-y-4">
        <button wire:click="fetchFirstDivProducts" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Show Products in First Div
        </button>
        <button wire:click="fetchSecondDivProducts" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded">
            Show Products in Second Div
        </button>
        <button wire:click="fetchThirdDivProducts" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
            Show Products in Third Div
        </button>
    </div>

    <!-- Display Products -->
    <div class="grid grid-cols-3 gap-4 mt-4">
    @forelse ($products as $product)
        <div class="p-4 bg-gray-100 dark:bg-zinc-700 rounded shadow">
            @if ($product->image_uri)
                <img src="{{ asset('storage/' . $product->image_uri) }}" alt="{{ $product->name }}" class="w-full h-24 object-cover rounded">
            @else
                <div class="w-full h-24 bg-gray-300 dark:bg-gray-600 flex items-center justify-center rounded">
                    <span class="text-gray-500 dark:text-gray-300">No Image</span>
                </div>
            @endif
            <h3 class="text-center text-gray-800 dark:text-white font-semibold mt-2">{{ $product->name }}</h3>
            <p class="text-center text-sm text-gray-600 dark:text-gray-400">Price: {{ number_format($product->price) }}</p>
            <p class="text-center text-sm text-gray-600 dark:text-gray-400">Stock: {{ $product->stock }}</p>
        </div>
     @empty
        <div class="col-span-3 text-center text-gray-600 dark:text-gray-400">
            No products available in this div.
        </div>
    @endforelse
</div>
</div>

<div class="p-6 bg-white dark:bg-zinc-800 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Manage Products</h2>

    <!-- پیام موفقیت -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- دکمه افزودن محصول -->
    <button wire:click="create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 space-x-reverse transition duration-200">
        <span>➕ افزودن محصول</span>
    </button>

    @if ($showForm)
    <div class="bg-gray-100 dark:bg-zinc-700 p-4 rounded-lg mb-4 mt-4 shadow-md">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
            {{ $isEditing ? '✏️ ویرایش محصول' : '➕ افزودن محصول' }}
        </h3>

        <input type="text" wire:model="name" placeholder="نام محصول" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white dark:border-gray-600 mb-2">
        <textarea wire:model="description" placeholder="توضیحات محصول" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white dark:border-gray-600 mb-2"></textarea>
        <input type="number" wire:model="price" placeholder="قیمت محصول" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white dark:border-gray-600 mb-2">
        <input type="number" wire:model="stock" placeholder="موجودی" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white dark:border-gray-600 mb-2">

        <select wire:model="category_id" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white dark:border-gray-600 mb-2">
            <option value="">دسته‌بندی را انتخاب کنید</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <div class="mb-2">
            <label for="image" class="block text-gray-800 dark:text-white mb-1">تصویر محصول</label>
            <input type="file" id="image" wire:model="image" class="w-full p-2 border rounded dark:bg-zinc-800 dark:text-white dark:border-gray-600">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button wire:click.prevent="{{ $isEditing ? 'update' : 'store' }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition duration-200">
            {{ $isEditing ? '✔️ بروزرسانی' : '✔️ ذخیره' }}
        </button>

        <button wire:click="resetFields" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded ml-2 transition duration-200">❌ لغو</button>
    </div>
    @endif

    <!-- لیست محصولات -->
    <div class="overflow-x-auto mt-4">
        <table class="w-full border border-gray-700 dark:border-gray-600 bg-gray-50 dark:bg-zinc-900 shadow-lg rounded-lg">
            <thead class="bg-gray-800 text-white dark:bg-zinc-700">
                <tr>
                    <th class="border p-3 text-center dark:text-white">تصویر</th>
                    <th class="border p-3 text-center dark:text-white">نام محصول</th>
                    <th class="border p-3 text-center dark:text-white">قیمت</th>
                    <th class="border p-3 text-center dark:text-white">موجودی</th>
                    <th class="border p-3 text-center dark:text-white">دسته‌بندی</th>
                    <th class="border p-3 text-center dark:text-white">عملیات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300 dark:divide-gray-600 bg-white dark:bg-zinc-800 text-gray-900 dark:text-gray-200">
                @foreach ($products as $product)
                    <tr wire:key="product-{{ $product->id }}" class="hover:bg-gray-100 dark:hover:bg-zinc-700 transition">
                        <td class="border p-3 text-center">
                            @if ($product->image_uri)
                            <img src="{{ asset('storage/' . $product->image_uri) }}" alt="Product Image" class="w-16 h-16 rounded-md mx-auto">
                            @else
                                <span class="text-gray-500 dark:text-gray-400">بدون تصویر</span>
                            @endif
                        </td>
                        <td class="border p-3 text-center">{{ $product->name }}</td>
                        <td class="border p-3 text-center text-green-700 dark:text-green-400 font-bold">{{ number_format($product->price) }} تومان</td>
                        <td class="border p-3 text-center">{{ $product->stock }}</td>
                        <td class="border p-3 text-center">{{ $product->category->name ?? 'نامشخص' }}</td>
                        <td class="border p-3 text-center">
                            <div class="flex justify-center space-x-2 space-x-reverse">
                                <button wire:click="edit({{ $product->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded transition duration-200">✏️ ویرایش</button>
                                <button wire:click="delete({{ $product->id }})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition duration-200">🗑️ حذف</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- صفحه‌بندی -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

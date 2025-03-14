<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;

class Products extends Component
{
    use WithPagination , WithFileUploads;

    public $name, $description, $price, $stock, $category_id, $product_id , $image;
    public $isEditing = false;
    public $showForm = false;
    protected $listeners = ['productUpdated' => 'render'];


    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ];

    public function render()
    {
        return view('livewire.admin.products', [
            'products' => Product::latest()->paginate(10), // ارسال محصولات به Blade
            'categories' => Category::all(),
        ])->with('layout', 'layouts.admin');
    }


    public function create()
    {
        $this->reset();
        $this->showForm = true;
    }

    public function resetFields()
    {
        $this->reset(['name', 'description', 'price', 'stock', 'category_id', 'product_id', 'isEditing']);
        $this->showForm = false;
    }

    public function store()
    {
        $imagePath = $this->image ? $this->image->store('images/products', 'public') : null;

        $this->validate();
        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'image_uri' => $imagePath,
        ]);
        session()->flash('message', 'محصول با موفقیت اضافه شد.');
        $this->resetFields();
        $this->dispatch('productUpdated'); // بروزرسانی لیست محصولات
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->isEditing = true;
        $this->showForm = true;
    }

    public function update()
    {
        $imagePath = $this->image ? $this->image->store('images/products', 'public') : null;

        $this->validate();
        Product::findOrFail($this->product_id)->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'image_uri' => $imagePath,
        ]);
        session()->flash('message', 'محصول با موفقیت ویرایش شد.');
        $this->resetFields();
        $this->dispatch("productUpdated"); // بروزرسانی لیست محصولات
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'محصول با موفقیت حذف شد.');
    }
}

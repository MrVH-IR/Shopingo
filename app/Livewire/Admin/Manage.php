<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\HomeProduct;

class Manage extends Component
{
    public $categories, $homeProduct;
    public $firstDiv, $secondDiv, $thirdDiv;

    public $products = []; // Declare products as a public property
    public $selectedDiv = 'first'; // Determines which products to show

    protected $rules = [
        'firstDiv' => 'nullable|exists:categories,id|different:secondDiv|different:thirdDiv',
        'secondDiv' => 'nullable|exists:categories,id|different:firstDiv|different:thirdDiv',
        'thirdDiv' => 'nullable|exists:categories,id|different:firstDiv|different:secondDiv',
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->homeProduct = HomeProduct::first();

        if ($this->homeProduct) {
            $this->firstDiv = $this->homeProduct->first_div;
            $this->secondDiv = $this->homeProduct->second_div;
            $this->thirdDiv = $this->homeProduct->third_div;
        }

        // Default to first div's products
        $this->fetchFirstDivProducts();
    }

    public function save()
    {
        $this->validate();

        if (!$this->homeProduct) {
            $this->homeProduct = HomeProduct::create([
                'first_div' => $this->firstDiv,
                'second_div' => $this->secondDiv,
                'third_div' => $this->thirdDiv,
            ]);
        } else {
            $this->homeProduct->update([
                'first_div' => $this->firstDiv,
                'second_div' => $this->secondDiv,
                'third_div' => $this->thirdDiv,
            ]);
        }

        session()->flash('message', 'Home Products Updated Successfully');
    }

    public function fetchFirstDivProducts()
    {
        $this->products = $this->firstDiv ? Product::where('category_id', $this->firstDiv)->get() : [];
    }

    public function fetchSecondDivProducts()
    {
        $this->products = $this->secondDiv ? Product::where('category_id', $this->secondDiv)->get() : [];
    }

    public function fetchThirdDivProducts()
    {
        $this->products = $this->thirdDiv ? Product::where('category_id', $this->thirdDiv)->get() : [];
    }

    public function render()
    {
        return view('livewire.admin.manage', [
            'categories' => $this->categories,
        ]);
    }
}

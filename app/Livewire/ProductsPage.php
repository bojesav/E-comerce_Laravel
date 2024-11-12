<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partial\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\Brand;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;

#[Title('Products')]
class ProductsPage extends Component
{
    use LivewireAlert; 
    use WithPagination;
     #[Url] // Removed undefined Url attribute
     public $selected_categories= [] ;

      #[Url] // Removed undefined Url attribute
     public $selected_brands = [];

     #[Url] // Removed undefined Url attribute
     public $featured ;

     #[Url] // Removed undefined Url attribute
     public $on_sale;

     #[Url] // Removed undefined Url attribute
     public $price_range = 10000000000 ;

     #[Url]
     public $sort ='latest';

        public function addToCart($product_id){
            $total_count = CartManagement::addItemToCart($product_id);

           $this->dispatch('update-cart-count',total_count:$total_count)->to(Navbar::class);

           $this->alert('success', 'Product to the cart successfully',[
            'position' =>  'bottom-end',
            'timer' =>  3000,
            'toast' =>  true,
           ]);
        }
    public function render()
    {
        $productQuery= Product::query()->where('is_active', 1 );

        if(!empty($this->selected_categories)){
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if(!empty($this->selected_brands)){
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if($this->featured){
            $productQuery->where('is_featured', 1);
        } 

        if($this->on_sale){
            $productQuery->where('on_sale', 1);
        }

        if($this->price_range){
            $productQuery->whereBetween('price', [0, $this->price_range]); 
        }

        if($this->sort == 'latest'){
            $productQuery->orderBy('price');
        }

        return view('livewire.products-page',[
            'products' => $productQuery->paginate(6),
            'brands' =>  Brand::Where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::Where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}

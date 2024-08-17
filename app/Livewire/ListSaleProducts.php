<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Tables\Columns\InputColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListSaleProducts extends Component implements HasForms, HasTable
{
    // protected $listeners = [
    //     'updateCart' => '$refresh',
    //     'clearSearch' => '$refresh', // Add a listener to refresh the page when the search filter is cleared
    // ];

    protected $listeners = [
        'updateCart' => 'updateCart',
        'updateGrandTotal' => 'updateGrandTotal',
    ];

    use InteractsWithForms;
    use InteractsWithTable;

    public $grandTotal = 0;
    public $cart = [];

    // protected $listeners = ['updateCart'];

    public function mount()
    {
        $this->cart = session('cart', []);
        $this->updateGrandTotal();
    }

   

    public function table(Table $table): Table
    {
        $user = auth()->user();

        return $table
            ->query(Product::query()
                // ->when($user->role_id == 4, function ($query) use ($user) {
                //     // Filter products by entity_id for role_id 4
                //     $query->where('entity_id', $user->entity_id);
                // })
               
                ->when($user->is_admin != 1, function ($query) use ($user) {
                    $query->where('entity_id', $user->entity_id);
                    // Filter products by department_id for other roles
                    // $query->whereHas('departments', function ($query) use ($user) {
                    //     $query->where('department_id', $user->department_id);
                    // });
                }))


            ->columns([
                Tables\Columns\TextColumn::make('ProductName')
                    ->label('Item')
                    ->sortable()
                    ->searchable(),
                
                InputColumn::make('Quantity')
                    ->label('Quantity To Sell'),
                CheckboxColumn::make('Insured')
                    ->label('Covered?')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->actions([
              
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([])
            ])
            ->searchable();
    }

    public function render(): View
    {
        $customers = Customer::all();

        return view('livewire.list-sale-products', compact('customers'), [
            'grandTotal' => $this->grandTotal,
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'cart.*' => 'numeric|min:1',
        ]);
    }

    public function updatedCart($productId, $quantity)
    {
        if ($quantity <= 0) {
            unset($this->cart[$productId]);
        } else {
            $this->cart[$productId] = $quantity;
        }
        $this->updateGrandTotal();
    }

    public function saveGrandTotal()
    {
        // Save the grand total to the database or perform any necessary actions
        Sale::create([
            'product_id' => json_encode(array_values(array_keys($this->cart))),
            'amount' => $this->grandTotal,
            'user_id' => auth()->id(),
            'entity_id' => auth()->user()->entity_id
        ]);

        session()->flash('message', 'Grand Total has been saved successfully!');
    }

    public function updateCart($productId, $quantity)
    {
        if ($quantity <= 0) {
            unset($this->cart[$productId]);
        } else {
            $this->cart[$productId] = $quantity;
        }

        // Flash updated cart to session
        session(['cart' => $this->cart]);

        $this->updateGrandTotal();
    }

    public function updateGrandTotal()
    {
        $this->grandTotal = collect($this->cart)->sum();
    }

    public function updateReceipt()
    {
        $customers = Customer::all();

        return view('livewire.list-sale-products', compact('customers'), [
            'grandTotal' => $this->grandTotal,
        ]);
    }
}

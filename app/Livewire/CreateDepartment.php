<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Entity;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateDepartment extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public array $entities = [];

    public function mount(): void
    {
        if (auth()->user()->role_id == 1) {
            $this->entities = Entity::pluck('EntityName', 'id')->toArray(); // Load all entities
        } else {
            $userEntityId = auth()->user()->entity_id;
            $this->entities = Entity::where('id', $userEntityId)->pluck('EntityName', 'id')->toArray(); // Load entity matching user's entity ID
        }
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        if (auth()->user()->role_id == 1) {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Service Point')
                        ->required(),
                    Forms\Components\TextInput::make('code')
                        ->label('Room Number (Optional)'),
                    Forms\Components\Select::make('entity_id')
                        ->label('Business')
                        ->searchable()
                        ->required()
                        ->options($this->entities),
                ])
                ->statePath('data')
                ->model(Department::class);
        } else {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Service Point')
                        ->required(),
                    Forms\Components\TextInput::make('code')
                        ->label('Room Number (Optional)'),
                ])
                ->statePath('data')
                ->model(Department::class);
        }
    }

    public function create(): void
    {
        $data = $this->form->getState();

        // If the user is not an admin, set the entity_id to the user's entity_id
        if (auth()->user()->role_id != 1) {
            $data['entity_id'] = auth()->user()->entity_id;
        }

        try {
            // Check if name or code already exists for the given entity_id
            $exists = Department::where('entity_id', $data['entity_id'])
                ->where(function ($query) use ($data) {
                    $query->where('name', $data['name'])
                          ->orWhere('code', $data['code']);
                })
                ->exists();

            if ($exists) {
                session()->flash('error', 'Service Point with the same name or room number already exists in your business');
                $this->redirectRoute('departments.create'); // Replace 'departments.index' with your actual route name
            } else {
                $record = Department::create($data);
                $this->form->model($record)->saveRelationships();

                // Flash a success message
                session()->flash('success', 'Service Point created successfully!');

                // Redirect to the index page
                $this->redirectRoute('departments.index'); // Replace 'departments.index' with your actual route name
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while creating the department.');
        }
    }

    public function render(): View
    {
        return view('livewire.create-department');
    }
}

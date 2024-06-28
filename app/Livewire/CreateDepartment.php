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
    // public ?array $data = [];
    public array $entities = []; // Add property to store entities

    public function mount(): void
    {
        $this->entities = Entity::pluck('EntityName', 'id')->toArray(); // Load entities
        $this->form->fill();
    }

    

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
              
                Forms\Components\Select::make('entity_id') // Change to Select
                    ->label('Pharmacy')
                    ->searchable()
                    ->required()
                    ->options($this->entities), // Set options for Select
            ])
            ->statePath('data')
            ->model(Department::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Department::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.create-department');
    }
}
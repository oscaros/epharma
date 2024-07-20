<?php

namespace App\Livewire;

use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Livewire\Notifications;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Notifications\Notification;

class EditDepartment extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Department $record;
 

    

    public function mount(Department $department): void
    {
        // $this->record = $department;
        // // $this->entity_id = $entity_id;
        // $this->form->fill($this->record->attributesToArray());

        $this->record = $department;
        $this->form->fill(array_merge(
            $this->record->attributesToArray(),
            ['EntityName' => $this->record->entity->EntityName ?? '..']
        ));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Service Point')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->label('Room Number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('EntityName')
                    ->label('Business')
                    //readonly
                    ->disabled()
                    ->required()
                    // ->numeric(),
            ])
            ->statePath('data')
            
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        // Remove the EntityName from the data as it is not an actual field in the departments table
        unset($data['EntityName']);
        
        $this->record->update($data);

        Notification::make()
            ->title('Updated ' . $this->record->name . ' successfully')
            ->success()
            ->send();

        // Redirect to the index route after successful update
        $this->redirectRoute('departments.index');
    }

    public function render(): View
    {
        
        return view('livewire.edit-department');
    }
}

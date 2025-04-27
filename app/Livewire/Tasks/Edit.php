<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Edit extends Component
{
    public Task $task;
    public array $form = [];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->form = $task->toArray();
    }

    public function render()
    {
        return view('livewire.tasks.edit', [
            'users' => User::all()
        ]);
    }

    public function rules(): array
    {
        return [
            'form.text' => 'required', // تأكد أن هذه القاعدة موجودة
            'form.user_id' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return $messages = [
            'form.text.required' => 'Text is required',
            'form.user_id.required' => 'User is required',
        ];
    }


    public function update()
    {
        $this->validate();

        $this->task->update($this->form);

        session()->flash('success', 'Task updated successfully!');
        return redirect()->route('tasks.index');
    }
}

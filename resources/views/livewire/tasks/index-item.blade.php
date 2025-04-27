<div>
    <tr>
        <td>{{ $task->id }}</td>
        <td>{{ $task->text }}</td>
        <td>{{ $task->user?->email }}</td>
        <td>{{ $task->created_at->format('Y-m-d') }}</td>
        <td class="text-center">
            <div class="dropdown" wire:ignore>
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    Actions
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="dropdown-item">Edit</a>
                    <a href="javascript:void(0);" class="dropdown-item"
                       wire:click="delete({{ $task->id }})">Delete</a>
                </div>
            </div>
        </td>
    </tr>
</div>

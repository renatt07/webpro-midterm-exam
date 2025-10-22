<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('My To-Do List') }}
    </h2>
</x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-900 text-green-300 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <label for="title" class="sr-only">New Task</label>
                        <div class="flex">
                            <input type="text" name="title" id="title" placeholder="What to do next?" 
                                   class="flex-grow rounded-l-md bg-gray-700 border-gray-600 text-gray-200 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500" required>
                            
                            <button type="submit" 
                                    class="px-4 py-2 bg-indigo-600 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700">
                                ADD TASK
                            </button>
                        </div>
                        @error('title')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>

            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="divide-y divide-gray-700"> @forelse ($tasks as $task)
                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="mr-4">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" name="is_complete" 
                                           class="rounded bg-gray-700 border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                           onChange="this.form.submit()"
                                           {{ $task->is_complete ? 'checked' : '' }}>
                                </form>
                                
                                <span class="{{ $task->is_complete ? 'line-through text-gray-500' : 'text-gray-200' }}">
                                    {{ $task->title }}
                                </span>
                            </div>
                            
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium" onclick="return confirm('Are you sure to delete this task?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="p-4 text-gray-400">
                            No task yet.
                        </div>
                    @endforelse
                </div>

                <div class="p-4 bg-gray-800 border-t border-gray-700 flex items-center justify-between text-sm text-gray-400">
                    
                    <span class="font-bold text-yellow-500">{{ $tasksRemaining }} task remaining</span>
                    
                    <div class="flex space-x-2">
                        <a href="{{ route('dashboard', ['filter' => 'all']) }}" class="{{ $filter == 'all' ? 'font-bold text-indigo-400' : 'hover:text-gray-200' }}">All</a>
                        <a href="{{ route('dashboard', ['filter' => 'active']) }}" class="{{ $filter == 'active' ? 'font-bold text-indigo-400' : 'hover:text-gray-200' }}">Active</a>
                        <a href="{{ route('dashboard', ['filter' => 'completed']) }}" class="{{ $filter == 'completed' ? 'font-bold text-indigo-400' : 'hover:text-gray-200' }}">Completed</a>
                    </div>
                    
                    <form action="{{ route('tasks.destroyCompleted') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="hover:text-red-400" onclick="return confirm('Are you sure to delete this finished task?')">
                            Clear Completed
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
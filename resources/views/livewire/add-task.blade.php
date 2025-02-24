<div style="background-color: #083055; color: white; min-height: 100vh; padding: 20px;">
    <!-- Main Container -->
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
                <h2 class="text-center">Add New Task</h2>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success mt-3">
                {!! session('message') !!}
            </div>
        @endif

        <!-- Form -->
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control text-black" id="title" wire:model.defer="title" required>
                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control text-black" id="description" wire:model.defer="description"></textarea>
                @error('description') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control text-black" id="due_date" wire:model.defer="due_date">
                @error('due_date') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control text-black" id="image" wire:model="image">
                @error('image') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="completed" wire:model.defer="completed">
                <label class="form-check-label" for="completed">Completed</label>
            </div>

            <!-- Tombol Add Task dipindah ke kiri bawah setelah "Completed" -->
            <div class="mt-3">
                <button type="submit" class="btn"
                    style="background-color: #FFA500; color: white; font-weight: bold; padding: 8px 16px; border-radius: 5px; transition: 0.3s;"
                    onmouseover="this.style.backgroundColor='#0096FF'"
                    onmouseout="this.style.backgroundColor='#FFA500'">
                    Add Task
                </button>
            </div>
        </form>
    </div>
</div>

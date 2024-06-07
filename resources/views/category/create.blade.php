<x-app-web-layout>
    <x-slot name="title">Add Categories</x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif  
                <div class="card">
                    <div class="card-header">
                        <h4>Add Categories
                            <a href="{{ url('categories/create') }}" class="btn btn-primary float-end">Add category</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="addCategoryForm" action="{{ url('categories/create') }}" method="post">
                            @csrf
                            <!-- for all category_table -->
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Is Active</label>
                                <input type="checkbox" name="is_active" {{ old('is_active') ? 'checked' : '' }}>
                                @error('is_active') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('saveButton').addEventListener('click', function(e) {
            e.preventDefault(); 
            alert("Your category has been saved!"); 
        });
    </script>
</x-app-web-layout>

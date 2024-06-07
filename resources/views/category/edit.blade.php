<x-app-web-layout>
    <x-slot name="title">Edit Categories</x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif  
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Categories
                            <a href="{{ url('categories/create') }}" class="btn btn-primary float-end" id="editCategoryButton">Edit category</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('categories/'.$category->id.'/edit') }}" method="post">
                            @csrf
                            @method('PUT')
                            <!-- for all category_table -->
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Is Active</label>
                                <input type="checkbox" name="is_active" {{ $category->is_active ? 'checked' : '' }}>
                                @error('is_active') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" id="updatee">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('editCategoryButton').addEventListener('click', function(e) {
            // e.preventDefault();
            alert("You clicked the Edit category button!");

        });
        document.getElementById('updatee').addEventListener('click', function(e) {
            // e.preventDefault();
            alert("Do you want to update the information?");

        });
    </script>
</x-app-web-layout>

<x-app-web-layout>
    <x-slot name="title">Categories</x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Categories
                            <a href="{{ url('categories/create') }}" class="btn btn-primary float-end">Add category</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <button type="submit" class="btn btn-primary toggle-status" 
                                                id="{{ $item->is_active ? 'Active' : 'Inactive' }}"
                                                data-category-id="{{ $item->id }}">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ url('categories/'.$item->id.'/edit') }}" class="btn btn-success mx-2">Edit</a>
                                        <a href="{{ url('categories/'.$item->id.'/delete') }}" class="btn btn-danger mx-1 deleteButton">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.deleteButton').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                alert("Do you really want to delete this category?");
            });
        });

        document.querySelectorAll('.toggle-status').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                let isActive = button.id === 'Active' ? false : true;
                let categoryId = button.dataset.categoryId;

                let confirmationMessage = isActive ? 
                    'Do you really want to make it active?' : 
                    'Do you really want to make it inactive?';

                if (!confirm(confirmationMessage)) {
                    return;
                }

                fetch('{{ route('category.updateStatus') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: categoryId,
                        is_active: isActive
                    })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        if (isActive) {
                            button.id = 'Active';
                            button.textContent = 'Active';
                            alert('The category is now active.');
                        } else {
                            button.id = 'Inactive';
                            button.textContent = 'Inactive';
                            alert('The category is now inactive.');
                        }
                    } else {
                        alert('Error updating status: ' + data.message);
                    }
                }).catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });
        });
    </script>
</x-app-web-layout>

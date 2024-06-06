<x-app-web-layout>
    <x-slot name="title">My laravel app</x-slot>
    <div class="py-5">
        <div class="container">
            <h4>Welcome to Index page</h4>
        </div>
    </div>
    <x-slot name="script">
        <script>
            alert("this is my script area");
        </script>
    </x-slot>
</x-app-web-layout>
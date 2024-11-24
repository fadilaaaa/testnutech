<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Welcome</h1>
        <div class="flex items-center space-x-4">
            <!-- Profile Image -->
            <a href="/profile" class="flex items-center">
                <img src="/images/profile.jpg" alt="User Profile"
                    class="w-10 h-10 rounded-full border-2 border-white hover:opacity-80">
            </a>
            <!-- Logout Button -->
            <button id="logout-btn" class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded">
                Logout
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Products</h2>
            <div class="flex justify-between items-center mb-4">
                <div class="flex space-x-4">
                    <a href="{{ route('products.create') }}" id="add-product-btn"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Add Product
                    </a>
                    <button id="export-excel-btn" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                        Export Excel
                    </button>
                </div>
                <div class="flex space-x-4">
                    <form action="" method="get">
                        <input type="text" id="search" placeholder="Search..." name="search"
                            value="{{ $query['search'] ?? '' }}" class="border border-gray-300 px-4 py-2 rounded">
                        <select id="category" class="border border-gray-300 px-4 py-2 rounded" name="category">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option @if (isset($query['category']) && $query['category'] == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input value="Search" type="submit" id="search-btn"
                            class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        </input>
                        <a href="/products" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Reset</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto mt-4">
            <table class="table-auto w-full border-collapse border border-gray-200 bg-white shadow-md rounded">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Product Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Selling Price</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Purchase Price</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Stock</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Foto</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="product-list">
                    @foreach ($products as $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->category->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp.
                                {{ number_format($item->selling_price, 2, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp.
                                {{ number_format($item->purchase_price, 2, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->stock }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="{{ $item->foto }}" alt="{{ $item->name }}" class="w-10 h-10">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <form id="delete-{{ $item->id }}"
                                    action="{{ route('products.destroy', $item->id) }}" method="post">
                                    <a href="{{ route('products.edit', $item->id) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-2 rounded mr-2">
                                        Edit
                                    </a>

                                    @csrf
                                    @method('delete')
                                    <button type="button" data-id="{{ $item->id }}"
                                        class="delete-btn bg-red-600 hover:bg-red-700 text-white py-1 px-2 rounded">
                                        Delete
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {!! $products->links('pagination::tailwind') !!}
        </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        © 2024 Aminudin Fadila Products. All Rights Reserved.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('add-product-btn').addEventListener('click', function() {
            window.location.href = '/products/create';
        });

        document.getElementById('search-btn').addEventListener('click', function() {
            const search = document.getElementById('search').value;
            const category = document.getElementById('category').value;
            window.location.href = `/products?search=${search}&category=${category}`;
        });
        document.getElementById('export-excel-btn').addEventListener('click', function() {
            const search = document.getElementById('search').value;
            const category = document.getElementById('category').value;
            window.location.href = '/products/export?search=' + search + '&category=' + category;
        });

        const deleteBtns = document.querySelectorAll('.delete-btn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                confirmdelete(id);
            });
        });

        const confirmdelete = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-${id}`).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
</body>

</html>

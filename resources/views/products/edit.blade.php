<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Edit Product</h1>
        <a href="/products" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Back to Products</a>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <div class="container mx-auto">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Product Name:</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}"
                        class="border border-gray-300 px-4 py-2 rounded w-full" required>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700">Category:</label>
                    <select id="category_id" name="category_id" class="border border-gray-300 px-4 py-2 rounded w-full"
                        required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="purchase_price" class="block text-gray-700">Purchase Price:</label>
                    <input type="number" id="purchase_price" name="purchase_price"
                        value="{{ $product->purchase_price }}" class="border border-gray-300 px-4 py-2 rounded w-full"
                        required>
                </div>
                <div class="mb-4">
                    <label for="selling_price" class="block text-gray-700">Selling Price:</label>
                    <input readonly type="number" id="selling_price" name="selling_price"
                        value="{{ $product->selling_price }}" class="border border-gray-300 px-4 py-2 rounded w-full"
                        required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700">Stock:</label>
                    <input type="number" id="stock" name="stock" value="{{ $product->stock }}"
                        class="border border-gray-300 px-4 py-2 rounded w-full" required>
                </div>
                <div class="mb-4">
                    <label for="foto" class="block text-gray-700">Foto:</label>
                    <input type="file" id="foto" name="foto"
                        class="border border-gray-300 px-4 py-2 rounded w-full">
                    @if ($product->foto)
                        <img src="{{ $product->foto }}" alt="{{ $product->name }}" class="mt-2 w-20 h-20">
                    @endif
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Update
                        Product</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        © 2024 Aminudin Fadila Products. All Rights Reserved.
    </footer>
    <script>
        document.getElementById('purchase_price').addEventListener('input', function(e) {
            let sellingPrice = document.getElementById('selling_price');
            sellingPrice.value = e.target.value * 1.3;
        });
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const url = URL.createObjectURL(file);
            document.querySelector('img').src = url;
        });
    </script>
</body>

</html>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Selling Price</th>
            <th>Purchase Price</th>
            <th>Stock</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name }}</td>
                <td>Rp. {{ number_format($item->selling_price, 2, ',', '.') }}</td>
                <td>Rp. {{ number_format($item->purchase_price, 2, ',', '.') }}</td>
                <td>{{ $item->stock }}</td>
            </tr>
        @endforeach
</table>

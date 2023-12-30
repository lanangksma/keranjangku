<!DOCTYPE html>
<html>
<head>
    <title>Product Table</title>
    <style>
        /* CSS untuk styling tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        caption {
            text-align: left;
            margin-bottom: 10px;
        }


    </style>
</head>
<body>
<h1>MY PRODUCT</h1>
<table>
    <caption>List Of Available Product</caption>
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <th scope="row">{{ $product->title }}</th>
            <td>{{ $product->description }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

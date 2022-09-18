<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section {
            background-color: #f17910;
            padding: 10px 40px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .text-red {
            color: rgb(231, 10, 10);
        }

        .company-details {
            float: right;
            text-align: right;
        }

        .body-section {
            padding: 16px;
            border: 1px solid gray;
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            border: 1px solid #111;
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        .table-bordered {
            box-shadow: 0px 0px 5px 0.5px gray;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 20%;
        }

        .float-right {
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">INVOICE</h1>
                </div>
                <div class="col-6">
                    <div class="company-details">
                        <p class="text-white">Company Address</p>
                        <p class="text-white">Company Email</p>
                        <p class="text-white">+94 XXXXXXXXX</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice ID :
                        INV-{{ $customerOrder->number }}{{ $customerOrder->customer->distributor->id }}</h2>
                    <p class="sub-heading"><b>Order Date:</b> {{ $customerOrder->created_at->format('Y/m/d') }} </p>
                    <p class="sub-heading"><b>Delivery Date:</b> {{ $customerOrder->deliver_date }} </p>
                </div>
                <div class="col-6">
                    <h2 class="heading">Order</h2>
                    <p class="sub-heading"><b>Purchase Order Number : </b> {{ $customerOrder->number }}</p>
                    <p class="sub-heading"><b>Deliver Date :</b> {{ $customerOrder->deliver_date }}</p>
                    <p class="sub-heading"><b>Status :</b> {{ $customerOrder->status }}</p>
                </div>
            </div>
        </div>
        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Distributor</h2>
                    <p class="sub-heading"><b>Name : </b> {{ $customerOrder->customer->distributor->name }}</p>
                    <p class="sub-heading"><b>Email Address :</b> {{ $customerOrder->customer->distributor->email }}</p>
                    <p class="sub-heading"><b>Phone Number :</b>{{ $customerOrder->customer->distributor->phone_number }}</p>
                    <p class="sub-heading"><b>Zone, Region, Territory :</b>
                        {{ $customerOrder->customer->distributor->territory->region->zone->name }},
                        {{ $customerOrder->customer->distributor->territory->region->name }},
                        {{ $customerOrder->customer->distributor->territory->name }}</p>
                </div>

                <div class="col-6">
                    <h2 class="heading">Customer</h2>
                    <p class="sub-heading"><b>Name : </b> {{ $customerOrder->customer->name }}</p>
                    <p class="sub-heading"><b>Address :</b> {{ $customerOrder->customer->address }}</p>
                    <p class="sub-heading"><b>Phone Number :</b>{{ $customerOrder->customer->phone_number }}</p>
                    <p class="sub-heading"><b>Email Address :</b>{{ $customerOrder->customer->email }}</p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th class="w-20">Product Name</th>
                        <th class="w-20">Available Quantity</th>
                        <th class="w-20">Order Quantity</th>
                        <th class="w-20">Unit Price</th>
                        <th class="w-20">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customerOrderProducts as $customerOrderProduct)
                        <tr>
                            <td>{{ $customerOrderProduct->product->name }}</td>

                            <td>
                                @if ($customerOrderProduct->product->quantity > 0)
                                    <div>
                                        {{ $customerOrderProduct->product->quantity }}
                                    </div>
                                @else
                                    <div class="text-red">Out of Stock</div>
                                @endif
                            </td>

                            <td>{{ $customerOrderProduct->quantity }}</td>

                            <td>{{ $customerOrderProduct->product->mrp }}</td>

                            <td>{{ $customerOrderProduct->total }}</td>
                        </tr>
                    @empty
                    @endforelse

                    @php
                        $grandTotal = 0;
                        foreach ($customerOrderProducts as $customerOrderProduct) {
                            $grandTotal = $grandTotal + $customerOrderProduct->total;
                        }
                    @endphp
                    <tr>
                        <td colspan="4" class="text-right">Grand Total</td>
                        <td> Rs.{{ $grandTotal }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="body-section">
            <p>&copy; {{ \Carbon\Carbon::now()->format('Y') }} - Company Name, All rights reserved.
                <a href="" class="float-right">www.example.com</a>
            </p>
        </div>
    </div>

</body>

</html>

@extends('layouts.backend_master')

@section('title', 'Report')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Report</h1>
    <div class="card p-4">
        <form id="reportForm">
            <div class="form-row">
                <!-- Year Selection -->
                <div class="form-group col-md-6">
                    <label for="year">Year</label>
                    <select class="form-control" id="year" name="year" onchange="viewReport()">
                    </select>
                </div>

                <!-- Month Selection -->
                <div class="form-group col-md-6">
                    <label for="month">Month</label>
                    <select class="form-control" id="month" name="month" onchange="viewReport()">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Report Display Section -->
    <div class="report-section mt-5">
        <h3 class="text-center">Report for Selected Year and Month</h3>
        <div id="report" class="text-center">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quentiy</th>
                        <th>Price</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @forelse($data['records'] as $record)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $record->product->name }}</td>
                            <td>{{ $record->product->category->name }}</td>
                            <td>{{ $record->total_quantity }}</td>
                            <td>{{ $record->product->price }}</td>
                            <td>{{ $record->total_quantity * $record->product->price }}</td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center">Sale products not found!</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection


@section('js')
<script>
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    (function () {
        const d = new Date();
        const y = d.getFullYear();
        let str = '';
        for (let i = 2022; i <= y; i++) {
            str += `<option value="${i}">${i}</option>`;
        }
        document.getElementById('year').innerHTML = str;
        document.getElementById('year').lastElementChild.selected = true;
        const m = d.getMonth() + 1;
        Array.from(document.getElementById('month').children).forEach(element => {
            if (element.value == m) {
                element.selected = true;
            }
        });
        viewReport();
    })();

    function viewReport() {
        const year = document.getElementById('year').value;
        const month = Number.parseInt(document.getElementById('month').value);

        fetch(`/backend/report/orders?year=${year}&month=${month}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const orders = data.data;

                    // Initialize HTML content for the report
                    let reportContent = `<h4>Orders for ${months[month - 1]} ${year}</h4>`;
                    if (orders.length == 0) {
                        reportContent += `<p class="text-primary"> Order not Found!</p>`;
                        report.innerHTML = reportContent;
                    } else {
                        // Loop through each order and add details to the report content
                        reportContent += `<table class="table  table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quentiy</th>
                        <th>Price</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody id="tbody">`;                

                        orders.forEach((order, index) => {                            
                            reportContent += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${order.product.name}</td>
                                    <td>${order.product.category.name}</td>
                                    <td>${order.total_quantity}</td>
                                    <td>${order.product.price}</td>
                                    <td>${order.total_quantity * order.product.price}</td>
                                </tr>`;
                                // console.log(typeof order.total_quantity);
                                

                            // Loop through each product in the order
                            // order.products.forEach(product => {
                            //     reportContent += `
                            //         <li>
                            //             <strong>Product ID:</strong> ${product.product_id},
                            //             <strong>Quantity:</strong> ${product.quantity},
                            //             <strong>Price:</strong> $${product.price}
                            //         </li>`;
                            // });

                            // reportContent += `</ul><hr>`;
                        });

                        // Set the report content in the designated area of the HTML
                        // document.getElementById('tbody').innerHTML = reportContent;
                        reportContent += `</tbody></table>`;
                        report.innerHTML =reportContent;
                    }

                } else {
                    // Display an error if no data found
                    // document.getElementById('reportContent').innerHTML = `<p class="text-danger">${data.error}</p>`;
                }
            })
            .catch(error => {
                console.log(error);

                // console.error('Error fetching report:', error);
                document.getElementById('report').innerHTML = `<p class="text-danger">An error occurred while fetching the report.</p>`;
            });
    }
</script>

@endsection
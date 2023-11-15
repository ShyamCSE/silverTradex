@extends('layouts.app')
@section('container')
    <div class="page-content">
        <div class="container-fluid">
                   <!-- start page title -->
                   <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 h2">Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Reports</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            </div>
<hr>
<div class="container">
    <div class="row justify-content-center mb-6">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="filterDropdown">Select Filter:</label>
                <select class="form-control" id="filterDropdown">
                <option selected disabled >Filter </option>
                    <option value="today">Today</option>
                    <option value="month">Month</option>
                    <option value="week">Week</option>
                    <option value="year">Year</option>
                    <option value="custom">Custom Date</option>
                </select>
            </div>
            <div id="customDateContainer" class="form-group col-12 " style="display:none;" >
            <div class="col-6">
                <label for="startDate">Start Date:</label>
                <input type="date" class="form-control" id="startDate" placeholder="Select Start Date">
</div>
<div class="col-6">
                <label for="endDate">End Date:</label>
                <input type="date" class="form-control" id="endDate" placeholder="Select End Date">
</div>
            </div>
        </div>
    </div>
    <!-- Your other content goes here -->
</div>
<hr>

<div class="container">
    <div class="row justify-content-center">

    <button type="button" class="col-sm-3 m-3 p-3 bg-white rounded  border shadow balanceStatement">
        <h5>Investment Statement</h5>
    </button>


        <div class="col-sm-3 m-3 p-3 bg-white rounded border shadow">
            <h5>Finance Statement</h5>
        </div>
        <div class="col-sm-3 m-3 p-3 bg-white rounded border shadow">
            <h5>Lot Account Statement</h5>
        </div>
        <div class="col-sm-3 m-3 p-3 bg-white rounded border shadow">
            <h5>International Pricing</h5>
        </div>
        <div class="col-sm-3 m-3 p-3 bg-white rounded border shadow">
            <h5>Expense In Percentage</h5>
        </div>
    </div>
</div>
    </div>

    <script>
function getFilterData() {
    let today = new Date();
    let startDate = $('#startDate').val() || new Date(today.getFullYear(), today.getMonth(), today.getDate() - 30).toISOString().split('T')[0];
    let endDate = $('#endDate').val() || new Date().toISOString().split('T')[0];

    return {
        startDate: startDate,
        endDate: endDate
    };
}


$(document).on('click', '.balanceStatement', function (event) {
    event.preventDefault();

    let filterData = getFilterData();
    let url = '{{ route("report.balanceStatement") }}?' + $.param(filterData);

    var link = document.createElement('a');
    link.href = url;
    link.download = 'InvestmentStatement.xlsx';
    link.click();
});





    document.getElementById('filterDropdown').addEventListener('change', function () {
    var customDateContainer = document.getElementById('customDateContainer');
    customDateContainer.style.display =  'flex' ;
    var today = new Date();
    var endDate = today.toISOString().split('T')[0]; // Today's date
    var startDate;

    switch (this.value) {
        case 'today':
            startDate = endDate;
            break;
        case 'month':
            startDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 30).toISOString().split('T')[0];
            break;
        case 'week':
           
            startDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7).toISOString().split('T')[0];
            break;
        case 'year':
            startDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 365).toISOString().split('T')[0];
            break;
        default:
            // Default to the current month
            startDate = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
            break;
    }

    document.getElementById('startDate').value = startDate;
    document.getElementById('endDate').value = endDate;
});

    </script>

    @endsection

   
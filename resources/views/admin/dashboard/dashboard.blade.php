@extends('admin.admin_layout')
@section('content')
<?php
    session_start();
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Số người dùng</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{$count_user}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Đơn hàng chưa duyệt</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{$count_pending_order}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <a href="{{ route('filter.status', ['status' => 'Đang chờ xác nhận']) }}">
                                    <i class="fa-solid fa-eye text-lg opacity-10" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Đơn hàng đã giao</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{$count_delivered_order}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <a href="{{ route('filter.status', ['status' => 'Đã giao hàng']) }}">
                                    <i class="fa-solid fa-eye text-lg opacity-10" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Doanh thu trong tháng này</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{number_format($total_revenue_current_month)}}đ
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Doanh thu theo tháng</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <div id="total_revenue"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Số đơn hàng đã giao theo tháng</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <div id="total_units_sold"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kiểm tra dữ liệu biểu đồ-->
    <!-- <div id="data-check">
        <strong>Revenue Data:</strong> {{ json_encode($revenue_data) }}<br>
        <strong>Order Data:</strong> {{ json_encode($order_data) }}<br>
        <strong>Months:</strong> {{ json_encode($num_of_months) }}
    </div> -->
</div>

<script type="text/javascript">
    var revenue_data = <?php echo json_encode(array_values($revenue_data)); ?>;
    var order_data = <?php echo json_encode(array_values($order_data)); ?>;
    var months = <?php echo json_encode($num_of_months); ?>;

    // Biểu đồ doanh thu theo tháng
    Highcharts.chart('total_revenue', {
        title: {
            text: 'Doanh thu theo năm 2024'
        },
        xAxis: {
            categories: months.map(month => `Tháng ${month}`),
        },
            yAxis: {
                title: {
                    text: 'Tổng doanh thu trong tháng'
                }
            },
            series: [{
                name: 'Doanh thu theo tháng',
                data: revenue_data
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        // Biểu đồ số đơn hàng đã giao theo tháng
        Highcharts.chart('total_units_sold', {
            title: {
                text: 'Số đơn hàng đã giao trong năm 2024'
            },
            xAxis: {
                categories: months.map(month => `Tháng ${month}`),
            },
            yAxis: {
                title: {
                    text: 'Số đơn hàng đã giao'
                }
            },
            series: [{
                name: 'Đơn hàng đã giao',
                data: order_data
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
</script>

@endsection

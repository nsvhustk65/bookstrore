@extends('admins.master')
@section('content')
    <div class="container mt-5">
    <h1 class="text-center">Thống Kê Doanh Thu Hàng Tháng</h1>

    <!-- Hiển thị bảng thống kê -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Tháng</th>
                <th>Năm</th>
                <th>Doanh Thu (VNĐ)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyRevenue as $row)
                <tr>
                    <td>{{ $row->month }}</td>
                    <td>{{ $row->year }}</td>
                    <td>{{ number_format($row->total_revenue, 0, ',', '.') }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container mt-4">
    <h2 class="text-center">Top 5 Sản Phẩm Bán Chạy Nhất</h2>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng Bán</th>
                <th>Doanh Thu (VNĐ)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProducts as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->ten_san_pham }}</td>
                    <td>{{ $product->total_quantity }}</td>
                    <td>{{ number_format($product->total_revenue, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Vẽ biểu đồ -->
    <div class="mt-5 bg-white">
        <h3 class="text-center">Biểu Đồ Doanh Thu Hàng Tháng</h3>
        <canvas id="revenueChart" width="400" height="200"></canvas>
    </div>
</div>


@endsection
@section('js')
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script>
         const months = @json($monthlyRevenue->pluck('month')); // Lấy danh sách tháng
    const revenues = @json($monthlyRevenue->pluck('total_revenue')); // Lấy doanh thu theo tháng

    // Vẽ biểu đồ
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ: cột
        data: {
            labels: months.map(month => `Tháng ${month}`), // Gắn nhãn là các tháng
            datasets: [{
                label: 'Doanh Thu (VNĐ)',
                data: revenues,
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Màu nền
                borderColor: 'rgba(75, 192, 192, 1)', // Màu viền
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Trục y bắt đầu từ 0
                }
            },
            responsive: true, // Đáp ứng trên mọi thiết bị
        }
    });
     </script>
@endsection

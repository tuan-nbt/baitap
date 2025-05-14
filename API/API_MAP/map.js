// Hàm initMap khởi tạo bản đồ Google Maps và hiển thị tuyến đường giữa điểm đón và điểm trả
function initMap(pickup, dropoff) {
    const directionsService = new google.maps.DirectionsService(); // Dịch vụ chỉ đường
    const directionsRenderer = new google.maps.DirectionsRenderer(); // Bộ hiển thị chỉ đường
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7, // Mức độ phóng to của bản đồ
        center: { lat: 10.8231, lng: 106.6297 }, // Tọa độ trung tâm mặc định (TP. Hồ Chí Minh)
    });
    directionsRenderer.setMap(map); // Gắn bộ hiển thị chỉ đường vào bản đồ

    const request = {
        origin: pickup, // Điểm bắt đầu (địa điểm đón)
        destination: dropoff, // Điểm kết thúc (địa điểm trả)
        travelMode: google.maps.TravelMode.DRIVING, // Phương thức di chuyển (lái xe)
    };

    // Gửi yêu cầu chỉ đường và xử lý kết quả
    directionsService.route(request, (result, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(result); // Hiển thị tuyến đường trên bản đồ
        } else {
            console.error("Không thể hiển thị chỉ đường do: " + status); // Ghi lỗi vào console
            alert("Không thể tải tuyến đường. Vui lòng kiểm tra lại địa điểm."); // Hiển thị thông báo lỗi
        }
    });
}
    
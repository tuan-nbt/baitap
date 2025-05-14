// Đảm bảo jQuery đã được tải
$(document).ready(function () {
    // Tối ưu hóa việc xử lý sự kiện bằng cách sử dụng event delegation
    $(document).on('click', '.dynamic-button', function () {
        // Xử lý sự kiện click cho các nút được thêm động
        console.log('Dynamic button clicked!');
    });

    // Giảm thiểu thao tác DOM bằng cách lưu trữ các tham chiếu
    const $header = $('#header');
    $header.addClass('optimized-header');

    // Lazy load hình ảnh để cải thiện hiệu suất
    $('img.lazy').each(function () {
        const $img = $(this);
        $img.attr('src', $img.data('src')).removeClass('lazy');
    });

    // Debounce cho sự kiện cuộn để giảm tải
    let scrollTimeout;
    $(window).on('scroll', function () {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function () {
            console.log('Scroll event optimized!');
        }, 200);
    });

    // Tối ưu hóa việc ẩn/hiện các phần tử
    $('.toggle-button').on('click', function () {
        const $target = $($(this).data('target'));
        $target.toggleClass('hidden');
    });

    // Sử dụng CSS transitions thay vì jQuery animations nếu có thể
    $('.fade-in').on('click', function () {
        $(this).addClass('visible');
    });

    // Xóa các sự kiện không cần thiết khi không sử dụng
    $(window).on('unload', function () {
        $(document).off();
        $(window).off();
    });
});

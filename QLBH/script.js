// script.js
$(document).ready(function () {
    // Danh sách tài khoản mẫu
    const accounts = [
        { email: "a@gmail.com", role: "admin" },
        { email: "b@gmail.com", role: "user" },
        { email: "v@gmail.com", role: "visitor" }, // Visitor mẫu
    ];

    let currentUser = {
        role: "visitor", // Mặc định là visitor
        email: "",
    };

    // Hàm cập nhật giao diện menu
    function updateMenu() {
        const menu = $("#menu");
        menu.empty(); // Xóa menu cũ

        if (currentUser.role === "admin") {
            menu.append('<li><a href="#" id="home-link">Trang chủ</a></li>');
            menu.append('<li><a href="#" id="about-link">Giới thiệu</a></li>');
            menu.append('<li><a href="#" id="view-link">Xem</a></li>');
            menu.append('<li><a href="#" id="add-link">Nhập</a></li>');
            menu.append('<li><a href="#" id="logout-link">Đăng xuất</a></li>');
        } else if (currentUser.role === "user") {
            menu.append('<li><a href="#" id="home-link">Trang chủ</a></li>');
            menu.append('<li><a href="#" id="about-link">Giới thiệu</a></li>');
            menu.append('<li><a href="#" id="view-link">Xem</a></li>');
            menu.append('<li><a href="#" id="logout-link">Đăng xuất</a></li>');
        } else {
            menu.append('<li><a href="#" id="home-link">Trang chủ</a></li>');
            menu.append('<li><a href="#" id="about-link">Giới thiệu</a></li>');
            menu.append('<li><a href="#" id="login-link">Đăng nhập</a></li>');
        }

        // Cập nhật quyền tài khoản
        $("#account-role").text(`Quyền tài khoản: ${currentUser.role}`);
    }

    // Load nội dung khi nhấn vào menu
    $(document).on("click", "#home-link", function () {
        $("#content").html("<h2>Trang Chủ</h2><p>Chào mừng bạn đến với hệ thống quản lý bán sách.</p>");
    });

    $(document).on("click", "#about-link", function () {
        $("#content").html("<h2>Giới Thiệu</h2><p>Đây là hệ thống quản lý bán sách được xây dựng bằng HTML, CSS, JavaScript và JQuery.</p>");
    });

    $(document).on("click", "#view-link", function () {
        $("#content").load("view.html");
    });

    $(document).on("click", "#add-link", function () {
        $("#content").load("add-book.html");
    });

    // Xử lý logic Đăng nhập
    $(document).on("click", "#login-link", function () {
        $("#content").load("login.html");
    });

    // Xử lý logic Đăng xuất
    $(document).on("click", "#logout-link", function () {
        currentUser = { role: "visitor", email: "" }; // Reset trạng thái
        alert("Bạn đã đăng xuất thành công!");
        updateMenu(); // Cập nhật lại menu
        $("#content").html("<h2>Trang Chủ</h2><p>Chào mừng bạn đến với hệ thống quản lý bán sách.</p>");
    });

    // Khi form đăng nhập được submit
    $(document).on("submit", "#login-form", function (e) {
        e.preventDefault();
        const email = $("#email").val();
        const password = $("#password").val();

        // Tìm tài khoản trong danh sách
        const account = accounts.find(acc => acc.email === email);
        if (account) {
            currentUser = { role: account.role, email: account.email };
            alert(`Đăng nhập thành công với quyền: ${currentUser.role}`);
        } else {
            currentUser = { role: "visitor", email };
            alert("Email không được nhận diện, đăng nhập với quyền Visitor.");
        }

        updateMenu(); // Cập nhật menu theo quyền
        $("#content").html("<h2>Trang Chủ</h2><p>Chào mừng bạn đến với hệ thống quản lý bán sách.</p>");
    });

    // Mặc định load Trang Chủ
    updateMenu(); // Lần đầu cập nhật menu
    $("#home-link").click();
});
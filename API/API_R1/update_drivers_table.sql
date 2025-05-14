-- Tạo bảng drivers
CREATE TABLE IF NOT EXISTS drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL,
    vehicle_type VARCHAR(100) NOT NULL,
    license_plate VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    experience INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

USE hotel_booking;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    personal_code VARCHAR(11) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(10) UNIQUE NOT NULL,
    bed_count INT NOT NULL CHECK (bed_count BETWEEN 1 AND 3),
    price_per_night DECIMAL(8,2) NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('active', 'cancelled') DEFAULT 'active',
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,
    INDEX idx_check_dates (check_in_date, check_out_date),
    INDEX idx_room_dates (room_id, check_in_date, check_out_date)
);

-- Insert sample data
INSERT INTO users (first_name, last_name, personal_code, email, password_hash, is_admin) VALUES
('Admin', 'User', '12345678901', 'admin@hotel.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE),
('John', 'Doe', '12345678902', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', FALSE),
('Jane', 'Smith', '12345678903', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', FALSE);

INSERT INTO rooms (room_number, bed_count, price_per_night, description) VALUES
('101', 1, 50.00, 'Hubane ühekohaline tuba'),
('102', 2, 75.00, 'Kahekohaline tuba vaatega aknale'),
('103', 3, 100.00, 'Kolmekohaline peretoaa'),
('201', 1, 60.00, 'Ühekohaline tuba kõrgemal korrusel'),
('202', 2, 85.00, 'Kahekohaline deluxe tuba'),
('203', 3, 120.00, 'Kolmekohaline suite'),
('301', 1, 70.00, 'Premium ühekohaline tuba'),
('302', 2, 95.00, 'Premium kahekohaline tuba');

INSERT INTO bookings (user_id, room_id, check_in_date, check_out_date, total_price, status) VALUES
(2, 1, '2024-12-15', '2024-12-18', 150.00, 'active'),
(3, 3, '2024-12-20', '2024-12-23', 300.00, 'active');
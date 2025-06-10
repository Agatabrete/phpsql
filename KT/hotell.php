<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agata Hotelli Broneeringute Süsteem</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg,rgb(187, 43, 110) 0%,rgb(180, 106, 170) 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h1 {
            color:rgb(201, 125, 191);
            margin-bottom: 20px;
            font-size: 2.5rem;
            font-weight: 300;
        }

        .user-type-selector {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .user-type-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(45deg,rgb(233, 122, 183),rgb(235, 31, 99));
            color: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .user-type-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .user-type-btn.active {
            background: linear-gradient(45deg,rgb(139, 11, 101),rgb(150, 16, 116));
            transform: scale(1.05);
        }

        .section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .section.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section h2 {
            color: #4a5568;
            margin-bottom: 25px;
            font-size: 1.8rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #4a5568;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color:rgb(184, 10, 54);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .btn {
            background: linear-gradient(45deg,rgb(234, 102, 179),rgb(194, 25, 81));
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 10px;
            margin-bottom: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-danger {
            background: linear-gradient(45deg, #f56565, #e53e3e);
        }

        .btn-success {
            background: linear-gradient(45deg,rgb(129, 13, 67),rgb(146, 21, 63));
        }

        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .room-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .room-card h3 {
            color: #4a5568;
            margin-bottom: 10px;
        }

        .room-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .room-price {
            font-size: 1.2rem;
            font-weight: bold;
            color:rgb(238, 12, 136);
        }

        .bookings-list {
            display: grid;
            gap: 15px;
            margin-top: 20px;
        }

        .booking-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
        }

        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .booking-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .alert {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(45deg, rgba(72, 187, 120, 0.1), rgba(56, 161, 105, 0.1));
            border: 1px solid #48bb78;
            color: #2f855a;
        }

        .alert-error {
            background: linear-gradient(45deg, rgba(245, 101, 101, 0.1), rgba(229, 62, 62, 0.1));
            border: 1px solid #f56565;
            color: #c53030;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #4a5568;
            font-size: 0.9rem;
        }

        .hidden {
            display: none !important;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .user-type-selector {
                flex-direction: column;
                align-items: center;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .booking-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Agata Hotelli Broneeringute Süsteem</h1>
            <div class="user-type-selector">
                <button class="user-type-btn active" onclick="switchUserType('customer')">Külastaja</button>
                <button class="user-type-btn" onclick="switchUserType('staff')">Hotelli Töötaja</button>
            </div>
        </div>

        <!-- Customer Interface -->
        <div id="customer-interface" class="section active">
            <!-- Available Rooms -->
            <div class="section active">
                <h2>Vabu Tube</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="search-checkin">Sisseregistreerimise kuupäev:</label>
                        <input type="date" id="search-checkin" onchange="searchRooms()">
                    </div>
                    <div class="form-group">
                        <label for="search-checkout">Väljaregistreerimise kuupäev:</label>
                        <input type="date" id="search-checkout" onchange="searchRooms()">
                    </div>
                    <div class="form-group">
                        <label for="search-capacity">Voodikohtade arv:</label>
                        <select id="search-capacity" onchange="searchRooms()">
                            <option value="">Kõik</option>
                            <option value="1">1 koht</option>
                            <option value="2">2 kohta</option>
                            <option value="3">3 kohta</option>
                        </select>
                    </div>
                </div>
                <div id="available-rooms" class="rooms-grid"></div>
            </div>

            <!-- Book Room -->
            <div class="section">
                <h2> Tee Broneering</h2>
                <div id="booking-alerts"></div>
                <form id="booking-form" class="form-grid">
                    <div class="form-group">
                        <label for="customer-firstname">Eesnimi:</label>
                        <input type="text" id="customer-firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="customer-lastname">Perekonnanimi:</label>
                        <input type="text" id="customer-lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="customer-id">Isikukood:</label>
                        <input type="text" id="customer-id" required pattern="[0-9]{11}" title="Sisesta 11-kohaline isikukood">
                    </div>
                    <div class="form-group">
                        <label for="customer-email">E-posti aadress:</label>
                        <input type="email" id="customer-email" required>
                    </div>
                    <div class="form-group">
                        <label for="booking-room">Vali tuba:</label>
                        <select id="booking-room" required>
                            <option value="">Vali tuba...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="booking-checkin">Sisseregistreerimise kuupäev:</label>
                        <input type="date" id="booking-checkin" required>
                    </div>
                    <div class="form-group">
                        <label for="booking-checkout">Väljaregistreerimise kuupäev:</label>
                        <input type="date" id="booking-checkout" required>
                    </div>
                </form>
                <button type="button" class="btn btn-success" onclick="createBooking()">Tee Broneering</button>
            </div>

            <!-- My Bookings -->
            <div class="section">
                <h2> Minu Broneeringud</h2>
                <div class="form-group">
                    <label for="my-bookings-email">Sisesta oma e-posti aadress:</label>
                    <input type="email" id="my-bookings-email" placeholder="example@email.com">
                    <button type="button" class="btn" onclick="loadMyBookings()">Otsi Broneeringuid</button>
                </div>
                <div id="my-bookings" class="bookings-list"></div>
            </div>
        </div>

        <!-- Staff Interface -->
        <div id="staff-interface" class="section">
            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" id="total-rooms">0</div>
                    <div class="stat-label">Kokku Tube</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="total-bookings">0</div>
                    <div class="stat-label">Aktiivseid Broneeringuid</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="occupancy-rate">0%</div>
                    <div class="stat-label">Täituvus Täna</div>
                </div>
            </div>

            <!-- Manage Bookings -->
            <div class="section active">
                <h2> Halda Broneeringuid</h2>
                <div id="staff-alerts"></div>
                <div id="all-bookings" class="bookings-list"></div>
            </div>

            <!-- Manage Rooms -->
            <div class="section">
                <h2> Halda Tube</h2>
                <form id="room-form" class="form-grid">
                    <div class="form-group">
                        <label for="room-number">Toa number:</label>
                        <input type="text" id="room-number" required>
                    </div>
                    <div class="form-group">
                        <label for="room-capacity">Voodikohtade arv:</label>
                        <select id="room-capacity" required>
                            <option value="1">1 koht</option>
                            <option value="2">2 kohta</option>
                            <option value="3">3 kohta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room-price">Hind (€/öö):</label>
                        <input type="number" id="room-price" min="0" step="0.01" required>
                    </div>
                </form>
                <button type="button" class="btn btn-success" onclick="createRoom()">Lisa Tuba</button>
                <div id="rooms-list" class="rooms-grid"></div>
            </div>
        </div>
    </div>

    <script>
        // Data Storage (In-memory database simulation)
        let rooms = [
            { id: 1, number: '101', capacity: 1, price: 65.00 },
            { id: 2, number: '102', capacity: 2, price: 95.00 },
            { id: 3, number: '103', capacity: 2, price: 95.00 },
            { id: 4, number: '201', capacity: 3, price: 125.00 },
            { id: 5, number: '202', capacity: 1, price: 65.00 },
            { id: 6, number: '203', capacity: 2, price: 95.00 }
        ];

        let bookings = [
            {
                id: 1,
                customer: {
                    firstName: 'Mari',
                    lastName: 'Tamm',
                    idCode: '39001010001',
                    email: 'mari.tamm@email.ee'
                },
                roomId: 1,
                checkIn: '2025-06-15',
                checkOut: '2025-06-18',
                status: 'active'
            },
            {
                id: 2,
                customer: {
                    firstName: 'Jaan',
                    lastName: 'Kask',
                    idCode: '38512120002',
                    email: 'jaan.kask@email.ee'
                },
                roomId: 3,
                checkIn: '2025-06-12',
                checkOut: '2025-06-14',
                status: 'active'
            }
        ];

        let nextRoomId = 7;
        let nextBookingId = 3;

        // User Interface Management
        function switchUserType(type) {
            const customerInterface = document.getElementById('customer-interface');
            const staffInterface = document.getElementById('staff-interface');
            const buttons = document.querySelectorAll('.user-type-btn');

            buttons.forEach(btn => btn.classList.remove('active'));
            
            if (type === 'customer') {
                customerInterface.classList.add('active');
                staffInterface.classList.remove('active');
                buttons[0].classList.add('active');
                searchRooms();
                updateRoomDropdown();
            } else {
                customerInterface.classList.remove('active');
                staffInterface.classList.add('active');
                buttons[1].classList.add('active');
                loadAllBookings();
                loadRoomsList();
                updateStatistics();
            }
        }

        // Room Search Functionality
        function searchRooms() {
            const checkIn = document.getElementById('search-checkin').value;
            const checkOut = document.getElementById('search-checkout').value;
            const capacity = document.getElementById('search-capacity').value;
            
            const availableRooms = getAvailableRooms(checkIn, checkOut, capacity);
            displayAvailableRooms(availableRooms);
        }

        function getAvailableRooms(checkIn, checkOut, capacity) {
            let availableRooms = rooms.filter(room => {
                if (capacity && room.capacity != capacity) return false;
                
                if (checkIn && checkOut) {
                    const isOccupied = bookings.some(booking => 
                        booking.roomId === room.id && 
                        booking.status === 'active' &&
                        !(new Date(checkOut) <= new Date(booking.checkIn) || 
                          new Date(checkIn) >= new Date(booking.checkOut))
                    );
                    return !isOccupied;
                }
                return true;
            });
            
            return availableRooms;
        }

        function displayAvailableRooms(availableRooms) {
            const container = document.getElementById('available-rooms');
            
            if (availableRooms.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; font-size: 1.1rem;">Valitud kriteeriumitele vastavaid tube ei leitud.</p>';
                return;
            }

            container.innerHTML = availableRooms.map(room => `
                <div class="room-card">
                    <h3>Tuba ${room.number}</h3>
                    <div class="room-info">
                        <span>${room.capacity} voodikohta</span>
                        <span class="room-price">€${room.price.toFixed(2)}/öö</span>
                    </div>
                    <button class="btn btn-success" onclick="selectRoom(${room.id})">Vali See Tuba</button>
                </div>
            `).join('');
        }

        function selectRoom(roomId) {
            const room = rooms.find(r => r.id === roomId);
            const select = document.getElementById('booking-room');
            select.value = roomId;
            
            // Scroll to booking form
            document.querySelector('#customer-interface .section:nth-child(2)').scrollIntoView({ 
                behavior: 'smooth' 
            });
            
            showAlert('booking-alerts', `Valitud tuba: ${room.number}`, 'success');
        }

        // Booking Management
        function updateRoomDropdown() {
            const select = document.getElementById('booking-room');
            select.innerHTML = '<option value="">Vali tuba...</option>' + 
                rooms.map(room => `<option value="${room.id}">Tuba ${room.number} (${room.capacity} kohta, €${room.price.toFixed(2)}/öö)</option>`).join('');
        }

        function createBooking() {
            const form = document.getElementById('booking-form');
            const formData = new FormData(form);
            
            const booking = {
                id: nextBookingId++,
                customer: {
                    firstName: document.getElementById('customer-firstname').value.trim(),
                    lastName: document.getElementById('customer-lastname').value.trim(),
                    idCode: document.getElementById('customer-id').value.trim(),
                    email: document.getElementById('customer-email').value.trim()
                },
                roomId: parseInt(document.getElementById('booking-room').value),
                checkIn: document.getElementById('booking-checkin').value,
                checkOut: document.getElementById('booking-checkout').value,
                status: 'active'
            };

            // Validation
            if (!validateBooking(booking)) return;

            // Check availability
            if (!isRoomAvailable(booking.roomId, booking.checkIn, booking.checkOut)) {
                showAlert('booking-alerts', 'Valitud tuba ei ole valitud perioodil vaba!', 'error');
                return;
            }

            bookings.push(booking);
            form.reset();
            showAlert('booking-alerts', 'Broneering edukalt loodud!', 'success');
            searchRooms(); // Refresh available rooms
        }

        function validateBooking(booking) {
            // Check required fields
            if (!booking.customer.firstName || !booking.customer.lastName || 
                !booking.customer.idCode || !booking.customer.email || 
                !booking.roomId || !booking.checkIn || !booking.checkOut) {
                showAlert('booking-alerts', 'Palun täida kõik väljad!', 'error');
                return false;
            }

            // Validate ID code (Estonian format)
            if (!/^[0-9]{11}$/.test(booking.customer.idCode)) {
                showAlert('booking-alerts', 'Isikukood peab olema 11-kohaline number!', 'error');
                return false;
            }

            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(booking.customer.email)) {
                showAlert('booking-alerts', 'Palun sisesta korrektne e-posti aadress!', 'error');
                return false;
            }

            // Validate dates
            const checkIn = new Date(booking.checkIn);
            const checkOut = new Date(booking.checkOut);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (checkIn < today) {
                showAlert('booking-alerts', 'Sisseregistreerimise kuupäev ei saa olla minevikus!', 'error');
                return false;
            }

            if (checkOut <= checkIn) {
                showAlert('booking-alerts', 'Väljaregistreerimise kuupäev peab olema hiljem kui sisseregistreerimise kuupäev!', 'error');
                return false;
            }

            return true;
        }

        function isRoomAvailable(roomId, checkIn, checkOut) {
            return !bookings.some(booking => 
                booking.roomId === roomId && 
                booking.status === 'active' &&
                !(new Date(checkOut) <= new Date(booking.checkIn) || 
                  new Date(checkIn) >= new Date(booking.checkOut))
            );
        }

        // Customer booking management
        function loadMyBookings() {
            const email = document.getElementById('my-bookings-email').value.trim();
            if (!email) {
                showAlert('my-bookings', 'Palun sisesta e-posti aadress!', 'error');
                return;
            }

            const customerBookings = bookings.filter(booking => 
                booking.customer.email.toLowerCase() === email.toLowerCase() && 
                booking.status === 'active'
            );

            displayMyBookings(customerBookings);
        }

        function displayMyBookings(customerBookings) {
            const container = document.getElementById('my-bookings');
            
            if (customerBookings.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666;">Aktiivseid broneeringuid ei leitud.</p>';
                return;
            }

            container.innerHTML = customerBookings.map(booking => {
                const room = rooms.find(r => r.id === booking.roomId);
                const canCancel = canCancelBooking(booking.checkIn);
                
                return `
                    <div class="booking-card">
                        <div class="booking-details">
                            <div><strong>Tuba:</strong> ${room ? room.number : 'N/A'}</div>
                            <div><strong>Sisseregistreerimine:</strong> ${formatDate(booking.checkIn)}</div>
                            <div><strong>Väljaregistreerimine:</strong> ${formatDate(booking.checkOut)}</div>
                            <div><strong>Hind:</strong> €${room ? (room.price * getDaysBetween(booking.checkIn, booking.checkOut)).toFixed(2) : 'N/A'}</div>
                        </div>
                        <div class="booking-actions">
                            ${canCancel ? 
                                `<button class="btn btn-danger" onclick="cancelBooking(${booking.id})">Tühista Broneering</button>` : 
                                '<span style="color: #666;">Tühistamine pole võimalik (vähem kui 3 päeva broneeringu alguseni)</span>'
                            }
                        </div>
                    </div>
                `;
            }).join('');
        }

        function canCancelBooking(checkIn) {
            const checkInDate = new Date(checkIn);
            const today = new Date();
            const daysDifference = Math.ceil((checkInDate - today) / (1000 * 60 * 60 * 24));
            return daysDifference >= 3;
        }

        function cancelBooking(bookingId) {
            if (confirm('Kas oled kindel, et soovid broneeringu tühistada?')) {
                const booking = bookings.find(b => b.id === bookingId);
                if (booking) {
                    booking.status = 'cancelled';
                    loadMyBookings(); // Refresh the list
                    showAlert('my-bookings', 'Broneering edukalt tühistatud!', 'success');
                }
            }
        }

        // Staff Interface Functions
        function loadAllBookings() {
            const activeBookings = bookings.filter(booking => booking.status === 'active');
            displayAllBookings(activeBookings);
        }

        function displayAllBookings(allBookings) {
            const container = document.getElementById('all-bookings');
            
            if (allBookings.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666;">Aktiivseid broneeringuid ei ole.</p>';
                return;
            }

            container.innerHTML = allBookings.map(booking => {
                const room = rooms.find(r => r.id === booking.roomId);
                
                return `
                    <div class="booking-card">
                        <div class="booking-details">
                            <div><strong>Klien:</strong> ${booking.customer.firstName} ${booking.customer.lastName}</div>
                            <div><strong>E-post:</strong> ${booking.customer.email}</div>
                            <div><strong>Isikukood:</strong> ${booking.customer.idCode}</div>
                            <div><strong>Tuba:</strong> ${room ? room.number : 'N/A'}</div>
                            <div><strong>Sisseregistreerimine:</strong> ${formatDate(booking.checkIn)}</div>
                            <div><strong>Väljaregistreerimine:</strong> ${formatDate(booking.checkOut)}</div>
                            <div><strong>Summa:</strong> €${room ? (room.price * getDaysBetween(booking.checkIn, booking.checkOut)).toFixed(2) : 'N/A'}</div>
                        </div>
                        <div class="booking-actions">
                            <button class="btn" onclick="editBooking(${booking.id})">Muuda</button>
                            <button class="btn btn-danger" onclick="adminCancelBooking(${booking.id})">Tühista</button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function adminCancelBooking(bookingId) {
            if (confirm('Kas oled kindel, et soovid selle broneeringu tühistada?')) {
                const booking = bookings.find(b => b.id === bookingId);
                if (booking) {
                    booking.status = 'cancelled';
                    loadAllBookings();
                    updateStatistics();
                    showAlert('staff-alerts', 'Broneering edukalt tühistatud!', 'success');
                }
            }
        }

        function editBooking(bookingId) {
            const booking = bookings.find(b => b.id === bookingId);
            if (!booking) return;

            const room = rooms.find(r => r.id === booking.roomId);
            const newCheckIn = prompt('Uus sisseregistreerimise kuupäev (YYYY-MM-DD):', booking.checkIn);
            const newCheckOut = prompt('Uus väljaregistreerimise kuupäev (YYYY-MM-DD):', booking.checkOut);

            if (newCheckIn && newCheckOut) {
                // Validate dates
                const checkInDate = new Date(newCheckIn);
                const checkOutDate = new Date(newCheckOut);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (checkInDate < today) {
                    showAlert('staff-alerts', 'Sisseregistreerimise kuupäev ei saa olla minevikus!', 'error');
                    return;
                }

                if (checkOutDate <= checkInDate) {
                    showAlert('staff-alerts', 'Väljaregistreerimise kuupäev peab olema hiljem kui sisseregistreerimise kuupäev!', 'error');
                    return;
                }

                // Check availability (excluding the current booking)
                const isAvailable = !bookings.some(b => 
                    b.id !== bookingId &&
                    b.roomId === booking.roomId && 
                    b.status === 'active' &&
                    !(new Date(newCheckOut) <= new Date(b.checkIn) || 
                      new Date(newCheckIn) >= new Date(b.checkOut))
                );

                if (!isAvailable) {
                    showAlert('staff-alerts', 'Tuba ei ole valitud perioodil vaba!', 'error');
                    return;
                }

                booking.checkIn = newCheckIn;
                booking.checkOut = newCheckOut;
                loadAllBookings();
                showAlert('staff-alerts', 'Broneering edukalt muudetud!', 'success');
            }
        }

        // Room Management
        function createRoom() {
            const number = document.getElementById('room-number').value.trim();
            const capacity = parseInt(document.getElementById('room-capacity').value);
            const price = parseFloat(document.getElementById('room-price').value);

            if (!number || !capacity || !price) {
                showAlert('staff-alerts', 'Palun täida kõik väljad!', 'error');
                return;
            }

            // Check if room number already exists
            if (rooms.some(room => room.number === number)) {
                showAlert('staff-alerts', 'Tuba selle numbriga juba eksisteerib!', 'error');
                return;
            }

            const newRoom = {
                id: nextRoomId++,
                number: number,
                capacity: capacity,
                price: price
            };

            rooms.push(newRoom);
            document.getElementById('room-form').reset();
            loadRoomsList();
            updateStatistics();
            updateRoomDropdown();
            showAlert('staff-alerts', 'Tuba edukalt lisatud!', 'success');
        }

        function loadRoomsList() {
            const container = document.getElementById('rooms-list');
            
            container.innerHTML = rooms.map(room => `
                <div class="room-card">
                    <h3>Tuba ${room.number}</h3>
                    <div class="room-info">
                        <span>${room.capacity} voodikohta</span>
                        <span class="room-price">€${room.price.toFixed(2)}/öö</span>
                    </div>
                    <div class="booking-actions">
                        <button class="btn" onclick="editRoom(${room.id})">Muuda</button>
                        <button class="btn btn-danger" onclick="deleteRoom(${room.id})">Kustuta</button>
                    </div>
                </div>
            `).join('');
        }

        function editRoom(roomId) {
            const room = rooms.find(r => r.id === roomId);
            if (!room) return;

            const newPrice = prompt('Uus hind (€/öö):', room.price);
            if (newPrice && !isNaN(newPrice) && parseFloat(newPrice) > 0) {
                room.price = parseFloat(newPrice);
                loadRoomsList();
                updateRoomDropdown();
                showAlert('staff-alerts', 'Toa andmed edukalt muudetud!', 'success');
            }
        }

        function deleteRoom(roomId) {
            // Check if room has active bookings
            const hasActiveBookings = bookings.some(booking => 
                booking.roomId === roomId && booking.status === 'active'
            );

            if (hasActiveBookings) {
                showAlert('staff-alerts', 'Tuba ei saa kustutada - sellel on aktiivseid broneeringuid!', 'error');
                return;
            }

            if (confirm('Kas oled kindel, et soovid selle toa kustutada?')) {
                rooms = rooms.filter(room => room.id !== roomId);
                loadRoomsList();
                updateStatistics();
                updateRoomDropdown();
                showAlert('staff-alerts', 'Tuba edukalt kustutatud!', 'success');
            }
        }

        // Statistics
        function updateStatistics() {
            const totalRooms = rooms.length;
            const activeBookings = bookings.filter(b => b.status === 'active').length;
            
            // Calculate occupancy rate for today
            const today = new Date().toISOString().split('T')[0];
            const occupiedToday = bookings.filter(booking => 
                booking.status === 'active' &&
                booking.checkIn <= today && 
                booking.checkOut > today
            ).length;
            
            const occupancyRate = totalRooms > 0 ? Math.round((occupiedToday / totalRooms) * 100) : 0;

            document.getElementById('total-rooms').textContent = totalRooms;
            document.getElementById('total-bookings').textContent = activeBookings;
            document.getElementById('occupancy-rate').textContent = occupancyRate + '%';
        }

        // Utility Functions
        function showAlert(containerId, message, type) {
            const container = document.getElementById(containerId);
            const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
            
            container.innerHTML = `<div class="alert ${alertClass}">${message}</div>`;
            
            // Auto-hide alert after 5 seconds
            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('et-EE', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            });
        }

        function getDaysBetween(checkIn, checkOut) {
            const checkInDate = new Date(checkIn);
            const checkOutDate = new Date(checkOut);
            const timeDifference = checkOutDate - checkInDate;
            return Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            // Set minimum dates to today
            const today = new Date().toISOString().split('T')[0];
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const tomorrowString = tomorrow.toISOString().split('T')[0];

            document.getElementById('search-checkin').min = today;
            document.getElementById('search-checkout').min = tomorrow;
            document.getElementById('booking-checkin').min = today;
            document.getElementById('booking-checkout').min = tomorrow;

            // Initialize customer interface
            searchRooms();
            updateRoomDropdown();
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Seats - CineBook</title>
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
</head>
<body>
    <header class="customer-header">
        <div class="header-container">
            <div class="header-left">
                <div class="logo">
                    <span class="logo-icon">🎬</span>
                    <span class="logo-text">CineBook</span>
                </div>
            </div>

            <nav class="header-nav">
                <a href="{{ route('movies.index') }}">🎥 Movies</a>
            </nav>

            <div class="header-right">
                @auth('web')
                    <div class="admin-profile">
                        <span class="admin-name">👋 {{ Auth::user()->name }}</span>
                        <form action="{{ route('customer.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">🚪 Logout</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="admin-main">
        <div class="seat-selection-container">
            <div style="text-align: center; margin-bottom: 40px;">
                <h1 class="page-title">Select Your Seats</h1>
                <p style="color: rgba(255, 255, 255, 0.7); font-size: 18px;">{{ $movie->title }}</p>
                <p style="color: rgba(255, 255, 255, 0.6);">
                    {{ \Carbon\Carbon::parse($showTime->show_date)->format('F d, Y') }} at 
                    {{ date('h:i A', strtotime($showTime->show_time)) }}
                </p>
            </div>

            <!-- Screen -->
            <div class="screen">
                🎬 SCREEN
            </div>

            <!-- Seats Grid -->
            <div class="seats-grid">
                @php
                    $seatsByRow = $seats->groupBy('seat_row');
                @endphp

                @foreach($seatsByRow as $row => $rowSeats)
                    <div class="seat-row">
                        <span class="row-label">{{ $row }}</span>
                        <div class="seats">
                            @foreach($rowSeats as $seat)
                                <button 
                                    type="button"
                                    class="seat {{ $seat->is_available ? ($seat->seat_type == 'vip' ? 'vip' : '') : 'booked' }}"
                                    data-seat-id="{{ $seat->id }}"
                                    data-seat-number="{{ $seat->seat_identifier }}"
                                    data-seat-type="{{ $seat->seat_type }}"
                                    data-base-price="{{ $showTime->price }}"
                                    {{ !$seat->is_available ? 'disabled' : '' }}
                                    onclick="toggleSeat(this)"
                                >
                                    {{ $seat->seat_number }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Legend -->
            <div class="seat-legend">
                <div class="legend-item">
                    <div class="legend-box" style="background: rgba(255, 255, 255, 0.1); border: 2px solid rgba(255, 255, 255, 0.2);"></div>
                    <span>Available</span>
                </div>
                <div class="legend-item">
                    <div class="legend-box" style="background: rgba(251, 191, 36, 0.2); border: 2px solid #fbbf24;"></div>
                    <span>VIP (+$5)</span>
                </div>
                <div class="legend-item">
                    <div class="legend-box" style="background: #10b981; border: 2px solid #10b981;"></div>
                    <span>Selected</span>
                </div>
                <div class="legend-item">
                    <div class="legend-box" style="background: rgba(239, 68, 68, 0.3); border: 2px solid #ef4444;"></div>
                    <span>Booked</span>
                </div>
            </div>

            <!-- Booking Summary -->
            <div class="booking-summary">
                <h3 class="summary-title">Booking Summary</h3>
                <div id="selectedSeatsList" style="margin-bottom: 15px; color: rgba(255, 255, 255, 0.7);">
                    No seats selected
                </div>
                <div class="summary-item">
                    <span>Base Price:</span>
                    <span id="basePrice">${{ number_format($showTime->price, 2) }}</span>
                </div>
                <div class="summary-item">
                    <span>VIP Surcharge:</span>
                    <span id="vipCharge">$0.00</span>
                </div>
                <div class="summary-item summary-total">
                    <span>Total:</span>
                    <span>$<span id="totalPrice">0.00</span></span>
                </div>
            </div>

            <!-- Booking Form -->
            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                <input type="hidden" name="show_time_id" value="{{ $showTime->id }}">
                <input type="hidden" name="seat_ids" id="seatIdsInput">
                <input type="hidden" name="total_price" id="totalPriceInput">

                <div style="background: rgba(20, 20, 30, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 30px; margin-top: 30px;">
                    <h3 style="margin-bottom: 25px;">Your Information</h3>

                    @auth
                        <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="customer_email" value="{{ Auth::user()->email }}">
                        <input type="hidden" name="customer_phone" value="{{ Auth::user()->phone }}">

                        <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 10px; padding: 20px; margin-bottom: 25px;">
                            <p style="color: #10b981; font-weight: 600; margin-bottom: 10px;">✅ Booking as:</p>
                            <p style="color: rgba(255, 255, 255, 0.9);">{{ Auth::user()->name }}</p>
                            <p style="color: rgba(255, 255, 255, 0.7); font-size: 14px;">{{ Auth::user()->email }}</p>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="customer_name">Full Name</label>
                            <input type="text" id="customer_name" name="customer_name" required>
                        </div>

                        <div class="form-group">
                            <label for="customer_email">Email Address</label>
                            <input type="email" id="customer_email" name="customer_email" required>
                        </div>

                        <div class="form-group">
                            <label for="customer_phone">Phone Number</label>
                            <input type="tel" id="customer_phone" name="customer_phone" required>
                        </div>
                    @endauth

                    <button type="submit" id="confirmBooking" disabled style="opacity: 0.5; cursor: not-allowed;">
                        Confirm Booking
                    </button>
                </div>
            </form>

            <div style="margin-top: 30px;">
                <a href="{{ route('movies.show', $movie->id) }}" class="action-btn outline">← Back to Movie</a>
            </div>
        </div>
    </main>

    <script>
        const selectedSeats = [];
        const basePrice = {{ $showTime->price }};
        const vipSurcharge = 5;

        function toggleSeat(button) {
            const seatId = button.dataset.seatId;
            const seatNumber = button.dataset.seatNumber;
            const seatType = button.dataset.seatType;

            if (button.classList.contains('selected')) {
                button.classList.remove('selected');
                const index = selectedSeats.findIndex(s => s.id === seatId);
                if (index > -1) selectedSeats.splice(index, 1);
            } else {
                button.classList.add('selected');
                selectedSeats.push({
                    id: seatId,
                    number: seatNumber,
                    type: seatType
                });
            }

            updateSummary();
        }

        function updateSummary() {
            const seatsList = document.getElementById('selectedSeatsList');
            const totalPriceEl = document.getElementById('totalPrice');
            const vipChargeEl = document.getElementById('vipCharge');
            const confirmBtn = document.getElementById('confirmBooking');
            const seatIdsInput = document.getElementById('seatIdsInput');
            const totalPriceInput = document.getElementById('totalPriceInput');

            if (selectedSeats.length === 0) {
                seatsList.textContent = 'No seats selected';
                totalPriceEl.textContent = '0.00';
                vipChargeEl.textContent = '$0.00';
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.5';
                confirmBtn.style.cursor = 'not-allowed';
                return;
            }

            const seatNumbers = selectedSeats.map(s => s.number).join(', ');
            seatsList.innerHTML = `<strong>${selectedSeats.length} seat(s):</strong> ${seatNumbers}`;

            const vipCount = selectedSeats.filter(s => s.type === 'vip').length;
            const vipTotal = vipCount * vipSurcharge;
            const totalPrice = (selectedSeats.length * basePrice) + vipTotal;

            vipChargeEl.textContent = '$' + vipTotal.toFixed(2);
            totalPriceEl.textContent = totalPrice.toFixed(2);

            seatIdsInput.value = selectedSeats.map(s => s.id).join(',');
            totalPriceInput.value = totalPrice.toFixed(2);

            confirmBtn.disabled = false;
            confirmBtn.style.opacity = '1';
            confirmBtn.style.cursor = 'pointer';
        }
    </script>
</body>
</html>

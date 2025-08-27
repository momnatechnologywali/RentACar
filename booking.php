<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentACar - Booking</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
 
        body {
            background-color: #ffe6f0;
            color: #333;
        }
 
        header {
            background: linear-gradient(135deg, #ff5e78, #ff8c9e);
            padding: 20px;
            text-align: center;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
 
        header h1 {
            font-size: 2.5em;
        }
 
        .booking-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
 
        .booking-form h2 {
            color: #ff5e78;
            margin-bottom: 20px;
        }
 
        .booking-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ff5e78;
            border-radius: 5px;
        }
 
        .booking-form button {
            background: #ff5e78;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
 
        .booking-form button:hover {
            background: #ff2e58;
        }
 
        .car-details {
            margin-bottom: 20px;
        }
 
        .car-details h3 {
            color: #ff5e78;
        }
 
        footer {
            background: #ff5e78;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
 
        @media (max-width: 768px) {
            .booking-form {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Book Your Car</h1>
    </header>
 
    <div class="booking-form">
        <div class="car-details" id="car-details">
            <!-- Car details will be populated by JavaScript -->
        </div>
        <h2>Booking Details</h2>
        <input type="text" id="name" placeholder="Full Name" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="tel" id="phone" placeholder="Phone Number" required>
        <input type="date" id="start-date" required>
        <input type="date" id="end-date" required>
        <button onclick="submitBooking()">Confirm Booking</button>
    </div>
 
    <footer>
        <p>&copy; 2025 RentACar. All rights reserved.</p>
    </footer>
 
    <script>
        const cars = [
            { id: 1, name: "Toyota Camry", type: "sedan", price: 50, fuel: "petrol", brand: "toyota", img: "https://via.placeholder.com/300x150" },
            { id: 2, name: "Honda CR-V", type: "suv", price: 70, fuel: "diesel", brand: "honda", img: "https://via.placeholder.com/300x150" },
            { id: 3, name: "BMW i3", type: "hatchback", price: 60, fuel: "electric", brand: "bmw", img: "https://via.placeholder.com/300x150" }
        ];
 
        function displayCarDetails() {
            const carId = localStorage.getItem("selectedCarId");
            const car = cars.find(c => c.id == carId);
            if (car) {
                const container = document.getElementById("car-details");
                container.innerHTML = `
                    <h3>${car.name}</h3>
                    <p>$${car.price}/day</p>
                    <p>Type: ${car.type}</p>
                    <p>Fuel: ${car.fuel}</p>
                    <img src="${car.img}" alt="${car.name}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px;">
                `;
            }
        }
 
        function submitBooking() {
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            const startDate = document.getElementById("start-date").value;
            const endDate = document.getElementById("end-date").value;
            const carId = localStorage.getItem("selectedCarId");
 
            if (name && email && phone && startDate && endDate && carId) {
                // Send booking data to server
                fetch("save_booking.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ carId, name, email, phone, startDate, endDate })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Booking confirmed! Check your email for details.");
                        window.location.href = "index.php";
                    } else {
                        alert("Booking failed. Please try again.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred. Please try again.");
                });
            } else {
                alert("Please fill all fields.");
            }
        }
 
        displayCarDetails();
    </script>
</body>
</html>

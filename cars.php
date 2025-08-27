<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentACar - Car Listings</title>
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
 
        .car-list {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
 
        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
 
        .car-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
 
        .car-card:hover {
            transform: translateY(-5px);
        }
 
        .car-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
 
        .car-card-content {
            padding: 15px;
        }
 
        .car-card-content h3 {
            color: #ff5e78;
        }
 
        .car-card-content p {
            margin: 5px 0;
        }
 
        .car-card-content button {
            background: #ff5e78;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
 
        .car-card-content button:hover {
            background: #ff2e58;
        }
 
        .sort {
            margin: 20px;
            text-align: right;
        }
 
        .sort select {
            padding: 10px;
            border: 1px solid #ff5e78;
            border-radius: 5px;
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
            .car-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Available Cars</h1>
    </header>
 
    <div class="sort">
        <select id="sort" onchange="sortCars()">
            <option value="">Sort By</option>
            <option value="low">Price: Low to High</option>
            <option value="high">Price: High to Low</option>
        </select>
    </div>
 
    <div class="car-list">
        <div class="car-grid" id="car-grid">
            <!-- Cars will be populated by JavaScript -->
        </div>
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
 
        function displayCars() {
            const container = document.getElementById("car-grid");
            container.innerHTML = "";
            cars.forEach(car => {
                const carCard = `
                    <div class="car-card">
                        <img src="${car.img}" alt="${car.name}">
                        <div class="car-card-content">
                            <h3>${car.name}</h3>
                            <p>$${car.price}/day</p>
                            <p>Type: ${car.type}</p>
                            <p>Fuel: ${car.fuel}</p>
                            <button onclick="goToBooking(${car.id})">Book Now</button>
                        </div>
                    </div>
                `;
                container.innerHTML += carCard;
            });
        }
 
        function sortCars() {
            const sortValue = document.getElementById("sort").value;
            let sortedCars = [...cars];
            if (sortValue === "low") sortedCars.sort((a, b) => a.price - b.price);
            if (sortValue === "high") sortedCars.sort((a, b) => b.price - a.price);
            displayCars();
        }
 
        function goToBooking(carId) {
            localStorage.setItem("selectedCarId", carId);
            window.location.href = "booking.php";
        }
 
        displayCars();
    </script>
</body>
</html>

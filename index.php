<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentACar - Home</title>
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
            margin-bottom: 10px;
        }
 
        .search-bar {
            background: white;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
 
        .search-bar input, .search-bar select {
            padding: 10px;
            border: 1px solid #ff5e78;
            border-radius: 5px;
            flex: 1;
            min-width: 150px;
        }
 
        .search-bar button {
            background: #ff5e78;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
 
        .search-bar button:hover {
            background: #ff2e58;
        }
 
        .featured-cars, .top-deals {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
 
        .featured-cars h2, .top-deals h2 {
            color: #ff5e78;
            margin-bottom: 20px;
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
 
        .filters {
            margin: 20px auto;
            max-width: 800px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
 
        .filters select {
            padding: 10px;
            border: 1px solid #ff5e78;
            border-radius: 5px;
            flex: 1;
            min-width: 150px;
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
            .search-bar {
                flex-direction: column;
            }
 
            .filters {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>RentACar</h1>
        <p>Find the perfect car for your journey</p>
    </header>
 
    <div class="search-bar">
        <input type="text" id="location" placeholder="Pickup Location">
        <input type="date" id="start-date">
        <input type="date" id="end-date">
        <button onclick="searchCars()">Search Cars</button>
    </div>
 
    <div class="filters">
        <select id="car-type">
            <option value="">Car Type</option>
            <option value="sedan">Sedan</option>
            <option value="suv">SUV</option>
            <option value="hatchback">Hatchback</option>
        </select>
        <select id="price-range">
            <option value="">Price Range</option>
            <option value="low">Low to High</option>
            <option value="high">High to Low</option>
        </select>
        <select id="fuel-type">
            <option value="">Fuel Type</option>
            <option value="petrol">Petrol</option>
            <option value="diesel">Diesel</option>
            <option value="electric">Electric</option>
        </select>
        <select id="brand">
            <option value="">Brand</option>
            <option value="toyota">Toyota</option>
            <option value="honda">Honda</option>
            <option value="bmw">BMW</option>
        </select>
    </div>
 
    <div class="featured-cars">
        <h2>Featured Cars</h2>
        <div class="car-grid" id="car-grid">
            <!-- Cars will be populated by JavaScript -->
        </div>
    </div>
 
    <div class="top-deals">
        <h2>Top Deals</h2>
        <div class="car-grid" id="top-deals-grid">
            <!-- Top deals will be populated by JavaScript -->
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
 
        function displayCars(containerId, carsToShow) {
            const container = document.getElementById(containerId);
            container.innerHTML = "";
            carsToShow.forEach(car => {
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
 
        function searchCars() {
            const location = document.getElementById("location").value;
            const startDate = document.getElementById("start-date").value;
            const endDate = document.getElementById("end-date").value;
            const carType = document.getElementById("car-type").value;
            const priceRange = document.getElementById("price-range").value;
            const fuelType = document.getElementById("fuel-type").value;
            const brand = document.getElementById("brand").value;
 
            let filteredCars = [...cars];
 
            if (carType) filteredCars = filteredCars.filter(car => car.type === carType);
            if (fuelType) filteredCars = filteredCars.filter(car => car.fuel === fuelType);
            if (brand) filteredCars = filteredCars.filter(car => car.brand === brand);
            if (priceRange === "low") filteredCars.sort((a, b) => a.price - b.price);
            if (priceRange === "high") filteredCars.sort((a, b) => b.price - a.price);
 
            displayCars("car-grid", filteredCars);
            window.location.href = "cars.php";
        }
 
        function goToBooking(carId) {
            localStorage.setItem("selectedCarId", carId);
            window.location.href = "booking.php";
        }
 
        // Initial display
        displayCars("car-grid", cars);
        displayCars("top-deals-grid", cars);
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tourist Map - Explore Egypt</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('opp.jpg'); /* صورة الخلفية */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            color: white;
        }

        /* تصميم شريط التنقل */
        #navLinks {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: rgba(0, 0, 0, 0.7); /* خلفية داكنة للشريط */
            position: fixed;
            top: 0;
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }

        #navLinks li {
            display: inline;
            margin: 0 15px;
        }

        #navLinks a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #navLinks a:hover {
            background-color: #007bff;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6); /* الخلفية السوداء الشفافة */
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding-top: 60px; /* لإفساح المجال لشريط التنقل */
        }

        header {
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* تعديل الخريطة لتكون بشكل مستطيل */
        #map {
            height: 90%; /* هنا خفضنا نسبة ارتفاع الخريطة لتناسب العرض */
            width: 80%;  /* عرض الخريطة يصبح أكبر قليلاً */
            border: 3px solid white;
            border-radius: 10px;
            margin-top: 20px;  /* لتوفير مسافة بين العنوان والخريطة */
        }
    </style>
</head>
<body>

    <!-- شريط التنقل -->
    <ul id="navLinks">
        <li><a href="index.php">Home</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="recommendations.php">🤖 Recommendations</a></li>
        <li><a href="itinerary.php">📝 My Trip Plan</a></li>
        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>

    <div class="overlay">
        <header>
            <h1>Tourist Map</h1>
            <p>Explore popular tourist destinations in Egypt</p>
        </header>

        <div id="map"></div>

        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script>
            // Initialize the map (Egypt's central coordinates)
            var map = L.map('map').setView([26.8206, 30.8025], 6); // مركز الخريطة على مصر مع تكبير لتغطية كامل البلاد

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Tourist locations with their coordinates and info (Egypt-wide)
            var touristLocations = [
                {
                    name: "The Pyramids of Giza",
                    coordinates: [29.9773, 31.1325],
                    description: "One of the Seven Wonders of the Ancient World."
                },
                {
                    name: "Egyptian Museum",
                    coordinates: [30.0470, 31.2336],
                    description: "Museum containing one of the largest collections of ancient Egyptian antiquities."
                },
                {
                    name: "Luxor Temple",
                    coordinates: [25.6995, 32.6396],
                    description: "An ancient Egyptian temple located on the east bank of the Nile River."
                },
                {
                    name: "Karnak Temple",
                    coordinates: [25.7185, 32.8797],
                    description: "A vast complex of temples in Luxor, one of Egypt’s most important religious sites."
                },
                {
                    name: "Valley of the Kings",
                    coordinates: [25.7405, 32.6017],
                    description: "The burial place of many of Egypt's pharaohs, including King Tutankhamun."
                },
                {
                    name: "Abu Simbel Temples",
                    coordinates: [22.3377, 31.6258],
                    description: "Temples built by Ramses II, famous for their colossal statues."
                },
                {
                    name: "Siwa Oasis",
                    coordinates: [29.2033, 25.6875],
                    description: "A beautiful oasis known for its natural springs and ancient ruins."
                },
                {
                    name: "Alexandria Library",
                    coordinates: [31.2156, 29.9553],
                    description: "The modern library in Alexandria, an intellectual and cultural hub."
                },
                {
                    name: "Cairo Citadel",
                    coordinates: [30.0444, 31.2600],
                    description: "A historic Islamic Cairo landmark and former seat of government."
                },
                {
                    name: "Mount Sinai",
                    coordinates: [28.5392, 33.9764],
                    description: "A sacred mountain, believed to be the location where Moses received the Ten Commandments."
                },
                {
                    name: "Sharm El Sheikh",
                    coordinates: [27.9158, 34.3299],
                    description: "A popular resort town known for its beautiful beaches and diving."
                }
            ];

            // Add markers for each tourist location
            touristLocations.forEach(function(location) {
                L.marker(location.coordinates)
                    .addTo(map)
                    .bindPopup("<b>" + location.name + "</b><br>" + location.description)
                    .openPopup();
            });
        </script>
    </div>

</body>
</html>

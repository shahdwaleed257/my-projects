<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recommendations - Intelligent Tourist System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* General styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('opp3.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* 🔥 دا السطر المهم */

            height: 100%;
            color: white;
            display: flex;
            flex-direction: column;
        }

        /* Navbar styles */
        nav {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 10px 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        }

        nav ul {
            list-style-type: none;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin: 0 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #FFD700;
        }

        /* Overlay styling */
        /* Overlay styling */
.overlay {
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3));
    min-height: 100vh;
    padding-top: 90px;
    padding-bottom: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    backdrop-filter: blur(2px);
}


        /* Header styling */
        header {
            font-size: 28px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 700;
            letter-spacing: 2px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        /* Form styles */
        .preferences-form {
            margin-bottom: 30px;
            text-align: center;
        }

        .preferences-form select, .preferences-form button {
            padding: 10px;
            font-size: 16px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            width: 250px;
            max-width: 90%;
            font-family: 'Poppins', sans-serif;
        }

        .preferences-form button {
            background-color: #FFD700;
            color: black;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .preferences-form button:hover {
            background-color: #f7d800;
        }

        /* Recommendations list */
        .recommendations {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .recommendation-item {
            margin-bottom: 15px;
            padding: 12px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
        }

        .recommendation-item:hover {
            transform: scale(1.05);
        }

        .recommendation-item img {
            width: 150px;
            height: 100px;
            border-radius: 8px;
            margin-right: 20px;
        }

        .recommendation-item-info {
            max-width: 500px;
        }

    </style>
</head>
<body>

<!-- Navbar -->
<nav>
    <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="search.php">Search</a></li>
    <li><a href="recommendations.php">🤖 Recommendations</a></li>
    <li><a href="itinerary.php">📝 My Trip Plan</a></li>
    <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</nav>

<div class="overlay">
    <header>
        <h1>AI-Based Tourist Recommendations</h1>
        <p>Tell us your preferences to get personalized suggestions:</p>
    </header>

    <div class="preferences-form">
        <select id="activityType">
            <option value="beach">Beaches</option>
            <option value="historic">Historic Sites</option>
            <option value="museum">Museums</option>
            <option value="nature">Nature & Parks</option>
        </select>
        <button onclick="generateRecommendations()">Get Recommendations</button>
    </div>

    <div class="recommendations" id="recommendationsList">
        <!-- Dynamic recommendations will be displayed here -->
    </div>
</div>

<script>
// Coordinates for the user's current location (Example: Cairo coordinates)
const userLocation = { lat: 30.0444, lon: 31.2357 }; // Cairo coordinates

// مواقع و صور لأنواع الأنشطة المختلفة (روابط صور شغالة)

const locations = {
    beach: [
        { name: 'Sharm El Sheikh Beach', lat: 27.9158, lon: 34.3299, image: 'https://media.istockphoto.com/id/157179680/photo/beach-at-red-sea-naama-bay-sharm-el-sheikh-egypt.jpg?s=1024x1024&w=is&k=20&c=-eUlQi1qnDehxLwsF7MHbrmJBqm7VLl99gULaGyv7_w=' },
        { name: 'Hurghada', lat: 27.2579, lon: 33.8116, image: 'https://media.istockphoto.com/id/1217439068/photo/mosque-with-fishing-boats-at-sea-in-egypt.jpg?s=1024x1024&w=is&k=20&c=o9Np2NNO6G6b8_hYroFG7Nbrsz_obnWZbHtpEX70Adw=' },
        { name: 'Marsa Alam Beach', lat: 25.5733, lon: 34.3896, image: 'https://media.istockphoto.com/id/174959772/photo/exotic-beach.jpg?s=1024x1024&w=is&k=20&c=pgWXsZMyYEI6Q9ltn9eDUq-PsEEs5XCFs1BOaEWA-tQ=' },
        { name: 'Alexandria Corniche', lat: 31.2156, lon: 29.9552, image: 'https://images.unsplash.com/photo-1722264221001-211fd811a57a?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
        { name: 'Ras Mohamed', lat: 27.2300, lon: 34.3655, image: 'https://media.istockphoto.com/id/91884087/photo/ras-mohamed-main-door.jpg?s=1024x1024&w=is&k=20&c=0V4YIBzXoAEAo2hxenRX_ylkEp4tm0uPTNz0uuhVpNY=' }
    ],
    historic: [
        { name: 'Pyramids of Giza', lat: 29.9792, lon: 31.1342, image: 'https://media.istockphoto.com/id/157182383/photo/pyramids-of-giza.jpg?s=1024x1024&w=is&k=20&c=orrhQKHTVWOlov3r9SpC8s8V5Du-upLvoII_fdJ5Pkc=' },
        { name: 'Luxor Temple', lat: 25.6992, lon: 32.6396, image: 'https://media.istockphoto.com/id/1355995823/photo/luxor-temple-famous-landmark-of-egypt-first-pylon-view.jpg?s=1024x1024&w=is&k=20&c=CpIP0iEIcqXYLWiRre0hH8Qu6qX8X3IkfnSZMSz4B90=' },
        { name: 'Valley of the Kings', lat: 25.7405, lon: 32.6011, image: 'https://media.istockphoto.com/id/2196153877/photo/woman-using-smartphone-and-taking-picture-while-visiting-the-inner-rooms-inside-the-tomb-of.jpg?s=1024x1024&w=is&k=20&c=AbMRy-N6_f2plzayah7PQOwFWPTk6C72DR5v5-tIMrA=' },
        { name: 'Abu Simbel', lat: 22.3375, lon: 31.6250, image: 'https://media.istockphoto.com/id/1305921584/photo/woman-walking-inside-abu-simbel-temples.jpg?s=1024x1024&w=is&k=20&c=KvnQitaQ6m1P9HtYKJidvlVivuyBT_czEJJFzqiAmsQ=' },
        { name: 'Karnak Temple', lat: 25.7180, lon: 32.6572, image: 'https://media.istockphoto.com/id/1074327858/photo/exploring-ancient-egyptian-temples.jpg?s=1024x1024&w=is&k=20&c=8Pqz_mDvxPHYt9a-o961KVVXs9EdDwWn_q4xDmFmUPM=' }
    ],
    museum: [
        { name: 'The Egyptian Museum', lat: 30.0444, lon: 31.2357, image: 'https://media.istockphoto.com/id/182042439/photo/egyptian-museum.jpg?s=1024x1024&w=is&k=20&c=cMrZgWNGrZYCb13Hfbb1LLgj53PT0vxaWS_cZ7lBNjQ=' },
        { name: 'National Museum of Egyptian Civilization', lat: 30.0228, lon: 31.2500, image: 'https://images.unsplash.com/photo-1699817674427-d053cf057c0b?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
        { name: 'Alexandria National Museum', lat: 31.2156, lon: 29.9552, image: 'https://media.istockphoto.com/id/157312764/photo/fortress-kait-bay-in-alexandria.jpg?s=1024x1024&w=is&k=20&c=IbqKBYclzSfI3nwK_1nuhv2b1-Nexd0bvPjcZ7JxcaU=' },
        { name: 'Coptic Museum', lat: 30.0500, lon: 31.2345, image: 'https://media.istockphoto.com/id/1411020763/photo/the-temple-of-ramesses-iii-luxor-egypt.jpg?s=1024x1024&w=is&k=20&c=bVODCcuRWqlfEp0QdHMDL9HX7dDsVdOJtX55-PiF544=' },
        { name: 'Museum of Islamic Art', lat: 30.0440, lon: 31.2600, image: 'https://images.unsplash.com/photo-1697471440561-31883775e9b2?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }
    ],
    nature: [
        { name: 'White Desert', lat: 26.6153, lon: 29.8086, image: 'https://media.istockphoto.com/id/182162375/photo/white-desert-twilight.jpg?s=1024x1024&w=is&k=20&c=ZVEJzmOKd7q1j6CfuGjAfuHSo-KzLiUmanmmsbB5AII=' },
        { name: 'Mount Sinai', lat: 28.5400, lon: 33.9747, image: 'https://media.istockphoto.com/id/529838325/photo/saint-catherines-monastery-in-egypt.jpg?s=1024x1024&w=is&k=20&c=lvySDkCTpJn3lwqmU9eKNwhgzl5DmC7JmL6jOdkLMes=' },
        { name: 'Wadi El Rayan', lat: 29.1078, lon: 30.9375, image: 'https://media.istockphoto.com/id/496657458/photo/wadi-el-rayan-waterfalls.jpg?s=1024x1024&w=is&k=20&c=OjF7e2F1Y6xK1ZNKTXiA3M3nuh3nglcFtZkeSU_WsR0=' },
        { name: 'Siwa Oasis', lat: 29.2023, lon: 25.6876, image: 'https://media.istockphoto.com/id/2152790625/photo/serene-salt-lake-under-wispy-clouds-in-siwa-oasis-egypt.jpg?s=1024x1024&w=is&k=20&c=E204fIEsoLdguu3QlxX58vEnHk_8jTiGO8eC2xaCnjU=' },
        { name: 'Fayoum Desert', lat: 29.3084, lon: 30.8429, image: 'https://media.istockphoto.com/id/2178837406/photo/whale-valley-wadi-el-hitan.jpg?s=1024x1024&w=is&k=20&c=4poktHs3rxdCIBB9P1nX4JhocZSRLVF1nHsz1LObqEo=' }
    ]
};

// دالة لحساب المسافة بين نقطتين
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // نصف قطر الأرض بالكيلومتر
    const dLat = (lat2 - lat1) * (Math.PI / 180);
    const dLon = (lon2 - lon1) * (Math.PI / 180);
    const a = Math.sin(dLat / 2) ** 2 +
              Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
              Math.sin(dLon / 2) ** 2;
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}

// دالة إنشاء التوصيات حسب نوع النشاط
function generateRecommendations() {
    const activity = document.getElementById('activityType').value;
    const list = locations[activity];

    // نحسب المسافة ونرتب حسب الأقرب
    const sorted = list.map(loc => ({
        ...loc,
        distance: calculateDistance(userLocation.lat, userLocation.lon, loc.lat, loc.lon)
    })).sort((a, b) => a.distance - b.distance);

    // نعرض التوصيات
    const container = document.getElementById('recommendationsList');
    container.innerHTML = '';

    sorted.forEach(place => {
        const item = document.createElement('div');
        item.className = 'recommendation-item';

        item.innerHTML = `
            <img src="${place.image}" alt="${place.name}">
            <div class="recommendation-item-info">
                <strong>${place.name}</strong><br>
                Distance: ${place.distance.toFixed(2)} km
            </div>
        `;
        container.appendChild(item);
    });
}
</script>
</body>
</html>

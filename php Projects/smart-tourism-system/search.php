<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Tourist Attractions</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background-image: url('opp.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      height: 100vh;
      color: white;
    }

    .navbar {
      background-color: rgba(0, 0, 0, 0.6);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 30px;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 999;
    }
    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
      color: #4CAF50;
    }
    .navbar ul {
      list-style: none;
      display: flex;
      gap: 20px;
    }
    .navbar a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      transition: color 0.3s;
    }
    .navbar a:hover {
      color: #4CAF50;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.5);
      height: 100vh;
      padding-top: 100px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      text-align: center;
      padding-left: 20px;
      padding-right: 20px;
      backdrop-filter: blur(5px);
      border-radius: 20px;
      margin: 20px;
    }

    h1 {
      font-size: 40px;
      font-weight: 700;
      margin-bottom: 30px;
      color: #f2f2f2;
      text-shadow: 2px 2px 4px #000;
    }

    input, button {
      padding: 15px;
      font-size: 18px;
      margin: 10px 5px;
      border-radius: 8px;
      border: none;
      width: 280px;
      max-width: 90%;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    input {
      background-color: #fff;
      color: #333;
    }

    button {
      background: linear-gradient(135deg, #4CAF50, #3e8e41);
      color: white;
      cursor: pointer;
      transition: background 0.4s ease;
    }

    button:hover {
      background: linear-gradient(135deg, #3e8e41, #2e7031);
    }

    #result {
      margin-top: 30px;
      background-color: rgba(255,255,255,0.15);
      padding: 25px;
      border-radius: 15px;
      width: 90%;
      max-width: 700px;
      text-align: left;
      color: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }

    img {
      width: 100%;
      max-width: 400px;
      border-radius: 10px;
      display: block;
      margin: 10px auto;
    }

    .directions {
      margin-top: 10px;
    }

    a.btn-link {
      color: #4CAF50;
      text-decoration: none;
      font-weight: bold;
    }

    a.btn-link:hover {
      text-decoration: underline;
    }

    @media (max-width: 600px) {
      .navbar ul {
        flex-direction: column;
        background-color: rgba(0,0,0,0.8);
        position: absolute;
        top: 60px;
        right: 0;
        width: 100%;
        display: none;
      }
      .navbar ul.show {
        display: flex;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="logo">Tourist Guide</div>
  <ul id="navLinks">
    <li><a href="index.php">Home</a></li>
    <li><a href="search.php">Search</a></li>
    <li><a href="recommendations.php">🤖 Recommendations</a></li>
    <li><a href="itinerary.php">📝 My Trip Plan</a></li>
    <li><a href="logout.php">🚪 Logout</a></li>
  </ul>
</div>

<div class="overlay">
  <h1>Search Tourist Place</h1>
  <input type="text" id="place" placeholder="Enter place name…" />
  <button onclick="searchPlace()">Search</button>
  <div id="result"></div>
</div>

<script>
  function haversine(lat1, lon1, lat2, lon2) {
    const R = 6371;
    const dLat = (lat2 - lat1) * Math.PI/180;
    const dLon = (lon2 - lon1) * Math.PI/180;
    const a = Math.sin(dLat/2)**2 +
              Math.cos(lat1*Math.PI/180)*Math.cos(lat2*Math.PI/180)*Math.sin(dLon/2)**2;
    return 2*R*Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  }

  function searchPlace() {
    const place = document.getElementById('place').value.trim();
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = 'Loading…';

    if (!navigator.geolocation) {
      resultDiv.innerHTML = 'Geolocation not supported.';
      return;
    }

    navigator.geolocation.getCurrentPosition(pos => {
      const userLat = pos.coords.latitude;
      const userLon = pos.coords.longitude;

      fetch(`https://en.wikipedia.org/api/rest_v1/page/summary/${encodeURIComponent(place)}`)
        .then(r => r.json())
        .then(data => {
          if (!data.extract) {
            resultDiv.innerHTML = 'Place not found on Wikipedia.';
            return;
          }

          const title = data.title;
          const desc  = data.extract;
          const thumb = data.thumbnail?.source || '';

          fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(place)}&format=json&limit=1`)
            .then(r => r.json())
            .then(loc => {
              if (!loc.length) {
                resultDiv.innerHTML = 'Coordinates not found.';
                return;
              }

              const placeLat = parseFloat(loc[0].lat);
              const placeLon = parseFloat(loc[0].lon);
              const dist = haversine(userLat, userLon, placeLat, placeLon).toFixed(2);

              const link = `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLon}&destination=${placeLat},${placeLon}`;

              resultDiv.innerHTML = `
                <h2>${title}</h2>
                <p>${desc}</p>
                ${thumb ? `<img src="${thumb}" alt="${title}">` : ''}
                <p><strong>Distance:</strong> ${dist} km</p>
                <div class="directions">
                  <a class="btn-link" href="${link}" target="_blank">🚗 Get Directions on Google Maps</a>
                </div>
              `;
            });
        })
        .catch(() => resultDiv.innerHTML = 'Error fetching data.');
    }, () => {
      resultDiv.innerHTML = 'Unable to get your location.';
    });
  }
</script>

</body>
</html>

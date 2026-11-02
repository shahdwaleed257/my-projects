<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tour Planner - Intelligent Tourist System</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-image: url('pyrmids.jpg');
      background-size: cover;
      background-position: center;
      color: white;
    }

    /* Navbar */
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
      box-sizing: border-box;
    }

    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      gap: 20px;
      margin: 0;
      padding: 0;
      flex-wrap: wrap;
    }

    .navbar ul li {
      white-space: nowrap;
    }

    .navbar ul li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      padding: 8px 12px;
      display: inline-block;
      transition: color 0.3s;
    }

    .navbar ul li a:hover {
      color: #ffd700;
    }

    /* Main Container */
    .container {
      padding: 40px 30px;
      background-color: rgba(0, 0, 0, 0.6);
      max-width: 850px;
      margin: 100px auto 30px;
      border-radius: 15px;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
    }

    .checkboxes {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 15px;
      margin: 20px 0;
    }

    label {
      display: block;
      padding: 12px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    label:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }

    input[type="checkbox"] {
      transform: scale(1.3);
      margin-right: 10px;
    }

    button {
      padding: 12px 25px;
      font-size: 18px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 20px;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #218838;
    }

    table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      border: 1px solid white;
    }

    th {
      background-color: #444;
    }

    .error {
      color: #ff5050;
      font-weight: bold;
      margin-top: 15px;
    }

    @media screen and (max-width: 600px) {
      .navbar ul {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

<div class="navbar">
  <div class="logo">Tour Planner</div>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="search.php">Search</a></li>
    <li><a href="recommendations.php">🤖 Recommendations</a></li>
    <li><a href="itinerary.php">📝 My Trip Plan</a></li>
    <li><a href="logout.php">🚪 Logout</a></li>
  </ul>
</div>

<div class="container">
  <h2>Select up to 4 activities for your week</h2>

  <form id="activityForm">
    <div class="checkboxes">
      <label><input type="checkbox" name="activity" value="Visit the Pyramids of Giza">Visit the Pyramids of Giza</label>
      <label><input type="checkbox" name="activity" value="Explore the Egyptian Museum">Explore the Egyptian Museum</label>
      <label><input type="checkbox" name="activity" value="Relax at Sharm El Sheikh Beach">Relax at Sharm El Sheikh Beach</label>
      <label><input type="checkbox" name="activity" value="Visit the Sphinx">Visit the Sphinx</label>
      <label><input type="checkbox" name="activity" value="Luxor Temple">Luxor Temple</label>
      <label><input type="checkbox" name="activity" value="Karnak Temple">Karnak Temple</label>
      <label><input type="checkbox" name="activity" value="Aswan Dam">Aswan Dam</label>
    </div>

    <button type="button" onclick="generatePlan()">Generate Itinerary</button>
    <div id="errorMsg" class="error"></div>
  </form>

  <div id="itineraryResult"></div>
</div>

<script>
  function generatePlan() {
    const checkboxes = document.querySelectorAll('input[name="activity"]:checked');
    const errorDiv = document.getElementById("errorMsg");
    const resultDiv = document.getElementById("itineraryResult");

    errorDiv.innerHTML = "";
    resultDiv.innerHTML = "";

    if (checkboxes.length === 0) {
      errorDiv.innerText = "Please select at least one activity.";
      return;
    }

    if (checkboxes.length > 4) {
      errorDiv.innerText = "You can only select up to 4 activities!";
      return;
    }

    let table = "<table><tr><th>Day</th><th>Activity</th></tr>";
    checkboxes.forEach((cb, index) => {
      table += `<tr><td>Day ${index + 1}</td><td>${cb.value}</td></tr>`;
    });
    table += "</table>";

    resultDiv.innerHTML = "<h3>Your Weekly Itinerary:</h3>" + table;
  }
</script>

</body>
</html>

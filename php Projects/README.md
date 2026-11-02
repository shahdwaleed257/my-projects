# PHP Projects

Each project is packaged as a `.zip`; unzip it into a web-server folder (XAMPP / WAMP `htdocs`) to run it.

| Archive | Description |
|---|---|
| `smart-tourism-system-main.zip` | **Smart Tourism System** — destination search, interactive map (Leaflet / OpenStreetMap), itinerary planning, bookings with confirmation, personalized recommendations, user registration, login, profile and password reset. Uses MySQL (database name `tourist_system`). UI design: [`Figma UI_UX`](../Figma%20UI_UX/) |
| `php project.zip` | **Student management app** (`student2`) — registration and login, home dashboard, add / edit students and a small API endpoint, backed by MySQL (`mysqli`) |
| `oop.zip` | **PHP OOP exercises** — classes and objects, constructors, getters/setters, inheritance, static members and constants, magic methods and object cloning |

## Running a project

1. Install XAMPP (or any Apache + PHP + MySQL stack) and start Apache and MySQL.
2. Unzip the project into `htdocs`.
3. Create the MySQL database and tables the project expects, then adjust the connection settings in the project's `connect*.php` / `Conect.php` file. (The SQL schema is not included in the archives yet.)
4. Open `http://localhost/<project-folder>/` in the browser.

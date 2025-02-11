<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weerstation Den Hoorn, Texel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .weather-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            padding: 20px;
            max-width: 300px;
            width: 100%;
        }
        h1 {
            font-size: 24px;
        }
        .weather-info {
            font-size: 18px;
            margin: 10px 0;
        }
        .temperature {
            font-size: 32px;
            font-weight: bold;
        }
        .icon {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="weather-container">
        <h1>Weer in Den Hoorn, Texel</h1>
        <img class="icon" src="" alt="Weericoon">
        <p class="weather-info">Temperatuur: <span class="temperature"></span>°C</p>
        <p class="weather-info">Weersomstandigheden: <span class="condition"></span></p>
        <p class="weather-info">Luchtvochtigheid: <span class="humidity"></span>%</p>
        <p class="weather-info">Wind: <span class="wind"></span> m/s</p>
    </div>

    <script>
        const apiKey = "JOUW_API_SLEUTEL";  // Vervang met je eigen API-sleutel
        const city = "Den Hoorn,NL";  // Locatie: Den Hoorn, Texel
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&lang=nl&appid=${apiKey}`;

        function getWeatherData() {
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Toon het weer
                    document.querySelector('.temperature').textContent = data.main.temp;
                    document.querySelector('.condition').textContent = data.weather[0].description;
                    document.querySelector('.humidity').textContent = data.main.humidity;
                    document.querySelector('.wind').textContent = data.wind.speed;
                    
                    // Toon het weericoon
                    const iconUrl = `http://openweathermap.org/img/wn/${data.weather[0].icon}.png`;
                    document.querySelector('.icon').src = iconUrl;
                })
                .catch(error => {
                    console.error("Er is een fout opgetreden:", error);
                    alert("Er is een probleem met het ophalen van de weergegevens.");
                });
        }

        // Haal de gegevens direct op en stel het in om elke 5 minuten (300 seconden) opnieuw te verversen
        getWeatherData();
        setInterval(getWeatherData, 300000);  // 300000 ms = 5 minuten
    </script>
</body>
</html>

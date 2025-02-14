<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/index.css"/>
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
    <footer>
        <ul>
            <li>
                <p>Informatie over locatie hier</p>
            </li>
            <li>
                <p>Info over eventuele andere locaties</p>
            </li>
            <li>
                <a href="imglogo"><img src="example.gif" alt="examplehtml"></a>
            </li>
            <li>
                <a href="imglogo"><img src="example.gif" alt="examplehtml"></a>
            </li>
            <li>
                <a href="imglogo"><img src="example.gif" alt="examplehtml"></a>
            </li>
        </ul>

        <div class="weather-container">
            <h1>Straatnaam 85, Alkmaar</h1>
            <img class="icon" src="" alt="Weericoon">
            <p class="weather-info">Temperatuur: <span class="temperature"></span>°C</p>
            <p class="weather-info">Weersomstandigheden: <span class="condition"></span></p>
            <p class="weather-info">Luchtvochtigheid: <span class="humidity"></span>%</p>
            <p class="weather-info">Wind: <span class="wind"></span> m/s</p>
        </div>
    </footer>

    <script>
        const apiKey = "33b5b57a69b7839e80af65a616547cb1";  
        const city = "alkmaar,NL";  
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&lang=nl&appid=${apiKey}`;

        function getWeatherData() {
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.temperature').textContent = data.main.temp;
                    document.querySelector('.condition').textContent = data.weather[0].description;
                    document.querySelector('.humidity').textContent = data.main.humidity;
                    document.querySelector('.wind').textContent = data.wind.speed;
                    
                    const iconUrl = `http://openweathermap.org/img/wn/${data.weather[0].icon}.png`;
                    document.querySelector('.icon').src = iconUrl;
                })
                .catch(error => {
                    console.error("Er is een fout opgetreden:", error);
                    alert("Er is een probleem met het ophalen van de weergegevens.");
                });
        }

        getWeatherData();
        setInterval(getWeatherData, 300000); 
    </script>
</body>
</html>
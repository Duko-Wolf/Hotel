<?php include('includes/session.php') ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/index.css"/>
    <title>Weerstation Den Hoorn, Texel</title>
    
    
</head>

<body>
<?php include('includes/navbar.php'); ?>
    <div class="weather-container">
        <h1>straatnaam 85, alkmaar</h1>
        <img class="icon" src="" alt="Weericoon">
        <p class="weather-info">Temperatuur: <span class="temperature"></span>°C</p>
        <p class="weather-info">Weersomstandigheden: <span class="condition"></span></p>
        <p class="weather-info">Luchtvochtigheid: <span class="humidity"></span>%</p>
        <p class="weather-info">Wind: <span class="wind"></span> m/s</p>
    </div>

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
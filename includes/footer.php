<footer>
    <link rel="stylesheet" href="styling/footer.css"/>
    <ul>
        <!-- <li>
            <p>Informatie over locatie hier</p>
        </li>
        <li>
            <p>Info over eventuele andere locaties</p>
        </li>  -->
        <!-- <li>
            <a href="imglogo"><img src="example.gif" alt="examplehtml"></a>
        </li>
        <li>
            <a href="imglogo"><img src="example.gif" alt="examplehtml"></a>
        </li>
        <li>
            <a href="imglogo"><img src="example.gif" alt="examplehtml"></a>
        </li> -->
    </ul>

    <div class="wheater">
        <div class="weather-container">
            <h2>Straatnaam 85, Alkmaar</h2>
            <p class="weather-info">Temperatuur: <span class="temperature"></span>°C</p>
            <p class="weather-info">Weersomstandigheden: <span class="condition"></span></p>
            <p class="weather-info">Luchtvochtigheid: <span class="humidity"></span>%</p>
            <p class="weather-info">Wind: <span class="wind"></span> m/s</p>
        </div>

        <?php if(!isset($_SESSION['name'])): ?>
            <button class="footer-button" onclick="window.location.href='admin.php'">
                .
            </button>
        <?php endif; ?>

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
                    })
                    .catch(error => {
                        console.error("Er is een fout opgetreden:", error);
                        alert("Er is een probleem met het ophalen van de weergegevens.");
                    });
            }
            document.addEventListener("DOMContentLoaded", getWeatherData);
            setInterval(getWeatherData, 300000);
        </script>
    </div>
</footer>
<!DOCTYPE html>
<html lang="en">

<body>
    <header>
        <h1>Reverse GeoCoding with Google Maps</h1>
    </header>
    <!-- write some stuff about a place here -->

   <p>Click the button to get your coordinates.</p>

    <button onclick="getLocation()">Try It</button>

    <p id="demo"></p>

    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
        }
    </script>
    <script>
        const KEY = "AIzaSyD8LFh53VddzDevOC6A5Jhln9KgpmpoExg";
        const LAT = -6.762005683734191;
        const LNG = 39.254017289197506;
        let url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${LAT},${LNG}&key=AIzaSyD1QQqFo-up3KsoKw8AEko98izYqsSxaDQ&libraries=places`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                let parts = data.results[0].address_components;
                document.body.insertAdjacentHTML(
                    "beforeend",
                    `<p>Formatted: ${data.results[0].formatted_address}</p>`
                );
                parts.forEach(part => {
                    if (part.types.includes("country")) {
                        //we found "country" inside the data.results[0].address_components[x].types array
                        document.body.insertAdjacentHTML(
                            "beforeend",
                            `<p>COUNTRY: ${part.long_name}</p>`
                        );
                    }
                    if (part.types.includes("administrative_area_level_1")) {
                        document.body.insertAdjacentHTML(
                            "beforeend",
                            `<p>PROVINCE: ${part.long_name}</p>`
                        );
                    }
                    if (part.types.includes("administrative_area_level_3")) {
                        document.body.insertAdjacentHTML(
                            "beforeend",
                            `<p>LEVEL 3: ${part.long_name}</p>`
                        );
                    }
                });
            })
            .catch(err => console.warn(err.message));
    </script>
</body>

</html>
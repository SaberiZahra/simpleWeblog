<?php
$apiKey = "c0c1f62be0cbef231fd57cc5ec361512";
$cityId = "130758";
$apiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response);
$currentTime = time();
?>

<link rel="stylesheet" href="../css/bootstrap.css">
<!--<link rel="stylesheet" href="../css/style.css">-->

<section class="vh-100">
    <div class="container py-5 h-100">

        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-4">

                <h3 class="mb-4 pb-2 fw-normal">Check the weather forecast</h3>

<!--                <div class="input-group rounded mb-3">-->
<!--                    <input type="search" class="form-control rounded" placeholder="City" aria-label="Search"-->
<!--                           aria-describedby="search-addon" />-->
<!--                    <a href="#!" type="button">-->
<!--            <span class="input-group-text border-0 fw-bold" id="search-addon">-->
<!--              Check!-->
<!--            </span>-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="btn-group" role="group" aria-label="Basic example">-->
<!--                    <button id="iran-btn" type="button" class="btn btn-secondary">Iran</button>-->
<!--                    <button id="palestine-btn" type="button" class="btn btn-secondary">Palestine</button>-->
<!--                    <button id="italy-btn" type="button" class="btn btn-secondary">Italy</button>-->
<!--                </div>-->

<!--                <div class="mb-4 pb-2">-->
<!--                    <div class="form-check form-check-inline">-->
<!--                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"-->
<!--                               value="option1" checked />-->
<!--                        <label class="form-check-label" for="inlineRadio1">Celsius</label>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-check form-check-inline">-->
<!--                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"-->
<!--                               value="option2" />-->
<!--                        <label class="form-check-label" for="inlineRadio2">Farenheit</label>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="card shadow-0 border">
                    <div class="card-body p-4">

                        <div></div>

                        <h4 class="mb-1 sfw-normal"><?php echo $data->name; ?> Weather Status</h4><br>
                        <p><?php echo date("jS F, Y", $currentTime); ?></p>
                        <p><?php echo ucwords($data->weather[0]->description); ?> <img src="https://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" />                        </p>
                        <p>Max: <strong><?php echo $data->main->temp_max; ?></strong>, Min: <strong><?php echo $data->main->temp_min; ?></strong></p>
                        <p>Humidity: <strong><?php echo $data->main->humidity; ?></strong> %</p>
                        <p>Wind: <strong><?php echo $data->wind->speed; ?></strong> km/h</p>

                        <div class="d-flex flex-row align-items-center">
                            <i class="fas fa-cloud fa-3x" style="color: #eee;"></i>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
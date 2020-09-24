<?php
foreach ($this->openweather["api"] as $api => $url) {
    
    $model = new \Modules\OpenWeather\Model;
    $model->class = $this->labelize($api);
    $model->namespace = $this->model["namespace"];
    $model->appid = $this->openweather["appid"];
    $model->url = $url;
    $model->lat = $this->openweather["lat"];
    $model->lon = $this->openweather["lon"];
    $model->lang = $this->openweather["lang"];
    $model->setup();
    
    echo sprintf("%s\%s", $model->namespace, $model->class) . PHP_EOL;
    ob_flush();    
}




<?php
namespace Modules\OpenWeather {
    trait Api {
        use \Modules\Node;
        public function xpath($query) : \DOMNodeList {
            $request = new $this->request;
            $request->lat = $this->lat;
            $request->lon = $this->lon;
            $request->lang = $this->lang;
            $xpath = new \DOMXPath($request->fetchDOM());
            return (object) $xpath->query($query);
        }
    }
}
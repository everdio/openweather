<?php
namespace Modules\OpenWeather {
    use \Components\Validation;
    use \Components\Validator;     
    final class Model extends \Components\Core\Mapper\Model {
        use \Modules\OpenWeather;
        public function __construct() {
            parent::__construct([
                "url" => new Validation(false, [new Validator\IsString]),
                "appid" => new Validation(false, [new Validator\IsString]),
                "lang" => new Validation(false, [new Validator\IsString]),
                "units" => new Validation("metric", [new Validator\IsString\InArray(["standard","metric","imperial"])]),
                "mode" => new Validation("xml", [new Validator\IsString\InArray(["xml", "json"])]),
                "lat" => new Validation(false, [new Validator\IsDouble]),
                "lon" => new Validation(false, [new Validator\IsDouble])
            ]);
            
            $this->model = __DIR__ . DIRECTORY_SEPARATOR . "Model.tpl";
            $this->use = "\Modules\OpenWeather";            
        }

        public function setup() {         
            $xpath = new \DOMXPath($this->fetchDOM());
            foreach ($xpath->query("//*") as $node) {
                $model = new \Modules\OpenWeather\Api\Model;
                $model->request = sprintf("%s\%s", $this->namespace, $this->class);
                $model->node = $node;
                $model->namespace = sprintf("%s\%s", $this->namespace, $this->class);
                $model->use = "\Modules\OpenWeather\Api";
                $model->setup();     
            }             

            unset ($this->lon);            
            unset ($this->lat);
            unset ($this->lang);
        }
    }
}
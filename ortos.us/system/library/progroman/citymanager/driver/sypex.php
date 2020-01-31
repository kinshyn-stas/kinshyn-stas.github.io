<?php
namespace progroman\CityManager\Driver;

use progroman\CityManager\Driver;

class Sypex extends Driver {

    private $sxgeo_path = '';

    protected function initGeoFilter() {
        $this->geo_filter = [];

        if ($this->sxgeo_path && file_exists($this->sxgeo_path)) {
            $sxGeo = new SxGeo($this->sxgeo_path);
            $data = $sxGeo->getCityFull($this->ip);

            if ($data) {
                $this->geo_filter = [
                    'city_name' => $data['city']['name_ru'],
                    'zone_name' => $data['region']['name_ru'],
                    'iso_code_2' => $data['country']['iso'],
                    'country_name' => $this->getCountryNameByIso($data['country'])
                ];
            }
        }
    }

    private function getCountryNameByIso($country) {
        if ($country['iso'] == 'BY') {
            return 'Белоруссия';
        }

        return $country['name_ru'];
    }

    public function setSxgeoPath($path) {
        $this->sxgeo_path = $path;
    }
}
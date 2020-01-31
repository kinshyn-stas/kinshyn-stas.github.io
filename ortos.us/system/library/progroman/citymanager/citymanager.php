<?php
namespace progroman\CityManager;

if (version_compare(phpversion(), '7.1', '<')) {
    require_once 'core-encoded-php56.php';
} elseif (version_compare(phpversion(), '7.2', '<')) {
    require_once 'core-encoded-php71.php';
} else {
    require_once 'core-encoded-php72.php';
}

class CityManager extends Core {
    const VERSION = '6.2';

    protected static $instance;

    public function setFias($fias_id) {
        $result = parent::setFias($fias_id);
        if ($result) {
            $this->forceSaveInSession();
        }

        return $result;
    }

    /**
     * Записывает адреса доставки и оплаты в сессию,
     * только если эти значения не были установлены ранее.
     * Не перезаписывает уже установленных значений.
     */
    public function saveInSession() {
        foreach ($this->getData() as $key => $value) {
            if (empty($this->session->data['payment_address'][$key])) {
                $this->session->data['payment_address'][$key] = $value;
            }

            if (empty($this->session->data['shipping_address'][$key])) {
                $this->session->data['shipping_address'][$key] = $value;
            }

            if (empty($this->session->data['simple']['payment_address'][$key])) {
                $this->session->data['simple']['payment_address'][$key] = $value;
            }

            if (empty($this->session->data['simple']['shipping_address'][$key])) {
                $this->session->data['simple']['shipping_address'][$key] = $value;
            }
        }
    }

    /**
     * Записывает адреса доставки и оплаты в сессию.
     * Используется, когда пользователь меняет регион вручную.
     */
    public function forceSaveInSession() {
        foreach ($this->getData() as $key => $value) {
            $this->session->data['payment_address'][$key] = $this->session->data['shipping_address'][$key]
                = $this->session->data['simple']['payment_address'][$key]
                = $this->session->data['simple']['shipping_address'][$key]
                = $value;

            // Для совместимости с Simple, вообще в OC2 такие поля не используются
            $this->session->data['shipping_' . $key] = $this->session->data['payment_' . $key] = $value;
        }
    }

    private function getData() {
        return [
            'country_id' => $this->getCountryId(),
            'zone_id' => $this->getZoneId(),
            'postcode' => $this->getPostcode(),
            'city' => $this->getShortCityName(),
        ];
    }

    protected function getBots() {
        return [
            'apis-google', 'mediapartners-google', 'adsbot', 'googlebot', 'yandex.com/bots', 'mail.ru_bot', 'stackrambler',
            'slurp', 'msnbot', 'bingbot', 'alexa.com'
        ];
    }

    protected function setCurrency($code) {
        $this->session->data['currency'] = $code;
        setcookie('currency', $code, time() + 60 * 60 * 24 * 30, '/', $this->getCookieDomain());
        setcookie($this->getCookieKey('currency'), $code, time() + 60 * 60 * 24 * 30, '/', $this->getCookieDomain());
    }

    static public function getSxgeoPath() {
        return DIR_UPLOAD . 'progroman/SxGeoCity.dat';
    }
}
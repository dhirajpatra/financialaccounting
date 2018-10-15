<?php

namespace App\Traits;

use Akaunting\Money\Money;
use Akaunting\Money\Currency;

trait Currencies
{
    public function convert($amount, $code, $rate, $format = false)
    {
        $default = new Currency(setting('general.default_currency', 'USD'));

        if ($format) {
            $money = Money::$code($amount, true)->convert($default, (float) $rate)->format();
        } else {
            $money = Money::$code($amount)->convert($default, (float) $rate)->getAmount();
        }

        return $money;
    }

    public function reverseConvert($amount, $code, $rate, $format = false)
    {
        $default = setting('general.default_currency', 'USD');

        $code = new Currency($code);

        if ($format) {
            $money = Money::$default($amount, true)->convert($code, (float) $rate)->format();
        } else {
            $money = Money::$default($amount)->convert($code, (float) $rate)->getAmount();
        }

        return $money;
    }

    public function dynamicConvert($default, $amount, $code, $rate, $format = false)
    {
        $code = new Currency($code);

        if ($format) {
            $money = Money::$default($amount, true)->convert($code, (float) $rate)->format();
        } else {
            $money = Money::$default($amount)->convert($code, (float) $rate)->getAmount();
        }

        return $money;
    }

    public function getConvertedAmount($format = false)
    {
        return $this->convert($this->amount, $this->currency_code, $this->currency_rate, $format);
    }

    public function getReverseConvertedAmount($format = false)
    {
        return $this->reverseConvert($this->amount, $this->currency_code, $this->currency_rate, $format);
    }

    public function getDynamicConvertedAmount($format = false)
    {
        return $this->dynamicConvert($this->default_currency_code, $this->amount, $this->currency_code, $this->currency_rate, $format);
    }

    /**
     * this function will convert money rate.
     *
     * @param [type] $amount
     * @param [type] $from
     * @param [type] $to
     */
    public function convertCurrencyRate($from, $to)
    {
        $converted = json_decode($this->curl_get_contents('https://free.currencyconverterapi.com/api/v6/convert?q='.$from.'_'.$to.'&compact=y'), true);

        if (empty($converted)) {
            return 0.0;
        } else {
            return number_format(round($converted[$from.'_'.$to]['val'], 3), 2);
        }
    }

    public function curl_get_contents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $html = curl_exec($ch);
        curl_close($ch);

        return $html;
    }
}

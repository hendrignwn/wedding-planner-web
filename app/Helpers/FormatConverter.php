<?php

namespace App\Helpers;

use DateTime;

/**
 * Description of FormatConverter
 * 
 * @author Hendri <hendri.gnw@gmail.com>
 */
class FormatConverter
{
    /**
     * Format string as date
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    public static function dateFormat($date, $format)
    {
        $date = new DateTime($date);

        return $date->format($format);
    }
	
	/**
	 * the date format into indonesian
	 * 
	 * @param type $date date or datetime
	 * @param type $format eg. (%Y-%m-%d) 
	 * @see type $format http://php.net/manual/en/function.strftime.php
	 * @return type
	 */
	public static function indoDateFormat($date, $format)
	{
		setLocale(LC_ALL, 'id_ID', 'ind', 'indonesia');
		return strftime($format, strtotime($date));	
	}
	
	/**
     * Format number to rupiah
     * @param float $value
     * @return string
     */
    public static function rupiahFormat($value, $decimal = 0)
    {
		return number_format($value, $decimal, ',', '.');
    }
	
	/**
     * Format number to dollar
     * @param float $value
     * @return string
     */
    public static function dollarFormat($value, $decimal = 0)
    {
		return number_format($value, $decimal, '.', ',');
    }
	
	/**
	 * 
	 * @param type $date
	 * @param type $interval
	 * @param type $format
	 * @return type
	 */
	public static function dateInIntervalFormat($date, $interval, $format = 'Y-m-d')
	{
		$date = date_create($date);
		date_add($date, date_interval_create_from_date_string($interval .' days'));
		
		return date_format($date, $format);
	}
	
	/**
	 * 
	 * @param type $validators
	 * @return type
	 */
	public static function parseValidatorErrors($validators)
	{
		$result = [];
		foreach ($validators->getRules() as $key => $attribute) {
			$errors = $validators->errors()->getMessages();
			if (array_key_exists($key, $errors)) {
				$result[$key] = implode('\n', $errors[$key]);
			} else {
				$result[$key] = null;
			}
		}
		return $result;
	}
	
	public static function convertMinuteToHour($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}
}
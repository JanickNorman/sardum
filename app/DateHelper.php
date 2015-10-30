<?php namespace App;
use \Form as Form;

class DateHelper {

	public function __construct() {

		$this->registerDateHelper();
	}

	private function registerDateHelper() {
		Form::macro('datetime', function($name) {
		    $years = value(function() {
		        $startYear = (int) date('Y');
		        $endYear = $startYear - 5;
		        $years = ['' => 'year'];
		        for($year = $startYear; $year > $endYear; $year--) {
		            $years[ $year ] = $year;
		        };
		        return $years;
		    });

		    $months = value(function() {
		        $months = ['' => 'month'];
		        for($month = 1; $month < 13; $month++) {
		            $timestamp = strtotime(date('Y'). '-'.$month.'-13');
		            $months[ $month ] = strftime('%B', $timestamp);
		        }
		        return $months;
		    });

		    $days = value(function() {
		        $days = ['' => 'day'];
		        for($day = 1; $day < 32; $day++) {
		            $days[ $day ] = $day;
		        }
		        return $days;
		    });

		    return Form::select($name.'[day]', $days) .
		        Form::select($name.'[month]', $months) .
		        Form::select($name.'[year]', $years);
		});
	}
}
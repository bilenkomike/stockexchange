<?php 


/*
Time: {
	year : Y,
	month: m,
	day : d,
	hour: H,
	minute: i,
	seconds: s
}
*/




class TimeDate {

	private const High_year = array('1','3','5','7','8','10','12');

	public static function ConvertTime ( $date = 'now') {
		if($date != 'now') {
			$date = explode(" ", $date);
			$date_array = array(
				'date' => array(
					'Y' => explode("-",$date[0])[0],
					'm' => explode("-",$date[0])[1],
					'd' => explode("-",$date[0])[2],
				),
				'time' => array(
					'H' => explode(":",$date[1])[0],
					'i' => explode(":",$date[1])[1],
					's' => explode(":",$date[1])[2],
				),

			);
		}
		else {
			$date_array = array(
				'date' => array(
					'Y' => date('Y'),
					'm' => date('m'),
					'd' => date('d'),
				),
				'time' => array(
					'H' => date('H'),
					'i' => date('i'),
					's' => date('s'),
				),

			);
		}
		
		return $date_array;
	}

	public static function TimeDateFormat ($format = 'Y-m-d H:i:s', $date = 'now', $__str__format = array( false , false, false, false, false, false)) {
		// $DiffDate = $format;
		
		if($date == 'now' ) {
			$date == self::ConvertTime();
		}

		
		
		if ( $format != '__str__' ) {
			$date = self::ConvertTime($date);
			foreach($date as $diff) {
				
				foreach($diff as $key_state => $state) {
					$format = str_replace($key_state, $state, $format);
				}
			}
			return $format;
		}
		else if( $format == '__str__' ) {
			$DiffDate = '';
			if( $__str__format[0] == true and $date['date']['Y'] != 0) {
				$DiffDate .= $date['date']['Y'];
				if( $date['date']['Y'] != 1 ) {
					$DiffDate .= ' Years ';
				}
				else {
					$DiffDate .= ' Year ';
				}
				
			}

			if( $__str__format[1] == true and $date['date']['m'] != 0) {
				$DiffDate .= $date['date']['m'];
				if( $date['date']['m'] != 1 ) {
					$DiffDate .=  ' Months ';
				}
				else {
					$DiffDate .= ' Month ';
				}
				
			}

			if( $__str__format[2] == true and $date['date']['d'] != 0) {
				$DiffDate .= $date['date']['d'];
				if( $date['date']['d'] != 1 ) {
					$DiffDate .= ' Days ';
				}
				else {
					$DiffDate .= ' Day ';
				}
				
			}

			if( $__str__format[3] == true) {
				$DiffDate .= $date['time']['H'];
				if( $date['time']['H'] != 1 ) {
					$DiffDate .= ' Hours ';
				}
				else {
					$DiffDate .= ' Hour ';
				}
				
			}

			if( $__str__format[4] == true) {
				$DiffDate .= $date['time']['i'];
				if( $date['time']['i'] != 1 ) {
					$DiffDate .= ' Minutes ';
				}
				else {
					$DiffDate .= ' Minute ';
				}
				
			}
			if( $__str__format[5] == true) {
				$DiffDate .= $date['time']['s'];
				if( $date['time']['s'] != 1 ) {
					$DiffDate .= ' Seconds ';
				}
				else {
					$DiffDate .= ' Second ';
				}
				
			}


		} 
		// $time = $DiffDate;

		// print_arr($DiffDate);
		return $DiffDate;//.'<br />'.$format
	}

	public static function TimeDateDifference($date1 = '', $date2 = 'now', $format = 'Y-m-d H:i:s', $__str__format = array(false , false, false, false, false, false)) {

		if($date2 == 'now') {
			$year2 = date('Y');
			$month2 = date('m');
			$day2 = date('d');
			$hour2 = date('H');
			$minute2 = date('i');
			$seconds2 = date('s');

		}
		else {
			$date2 = self::ConvertTime($date2);
			$year2 = $date2['date']['Y'];
			$month2 = $date2['date']['m'];
			$day2 = $date2['date']['d'];
			$hour2 = $date2['time']['H'];
			$minute2 = $date2['time']['i'];
			$seconds2 = $date2['time']['s'];

		}


		$date1 = self::ConvertTime($date1);
		$year1 = $date1['date']['Y'];
		$month1 = $date1['date']['m'];
		$day1 = $date1['date']['d'];
		$hour1 = $date1['time']['H'];
		$minute1 = $date1['time']['i'];
		$seconds1 = $date1['time']['s'];

		$difference = array(
			'date' => array(
				'Y' => $year2 - $year1,
				'm' => $month2 - $month1,
				'd' => $day2 - $day1
			),
			'time' => array(
				'H' => $hour2 - $hour1,
				'i' => $minute2 - $mimute1,
				's' => $sreconds2 - $deconds1
			) 
		);


		if( $difference['time']['s'] < 0 ) {
			$difference['time']['i'] -= 1;
			$difference['time']['s'] += 60;
		}

		if( $difference['time']['i'] < 0) {
			$difference['time']['H'] -= 1;
			$difference['time']['i'] += 60;

		}

		if( $difference['time']['H'] < 0 ) {
			$difference['date']['d'] -= 1;
			$difference['time']['H'] += 24;
		}
		
		if($difference['date']['d'] < 0) {
			$difference['date']['d'] += 30;
			if(in_array($month2, self::High_year)) {
				
				$difference['date']['d'] += 1;
			}
			
			$difference['date']['m'] -= 1;
		}

		if($difference['date']['m'] < 0) {
			$difference['date']['m'] += 12;
			
			$difference['date']['Y'] -= 1;
		}


		
		// return $difference;
		return self::TimeDateFormat($format,$difference, $__str__format);
	}

	// 0-1-22 6:0:0


}
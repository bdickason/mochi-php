<?php

$db = new mysqli('localhost', 'root', '', 'salon');

function parse_addr($addr1, $addr2)
{
	//apartment number
	if (preg_match('/(suite|apartment|apt\.|apt|#)\s*(.*)/i', $addr2, $m))
	{
		return Array($addr1, $m[2]);
	}
	elseif(preg_match('/([a-z\-0-9\'\s\/]*)/i', $addr2, $m))
	{
		return Array($addr1, $m[1]);
	}
	else
	{
		return Array($addr1.' '.$addr2, '');
	}
}

$sql = "SELECT
			uid,
			home_phone,
			home_phone_area,
			work_phone,
			work_phone_area,
			other_phone,
			other_phone_area,
			addr1,
			addr2,
			date_registered,
			dob
		FROM
			user_import";

$res = $db->query($sql);

echo $res->num_rows . '<br/>';

$mod = array();

echo '<table>';

while($row = $res->fetch_assoc())
{
	List($addr, $apt) = parse_addr($row['addr1'], $row['addr2']);
	
	$data = array('uid' => $row['uid'], 'addr' => $addr, 'apt' => $apt);	
	
	$data['reg_date'] = Date('Y-m-d', strtotime($row['date_registered']));
	$data['dob'] = Date('Y-m-d', strtotime($row['dob']));
	
	$dob_tmp = preg_replace('#[\s+/]+#', '', $row['dob']);
	
	if (empty($dob_tmp))
	{	
		$data['dob'] = '';
	}
	
	$data['p1'] = '';
	$data['p1t'] = '';
	$data['p2'] = '';
	$data['p2t'] = '';
	
	$queue = array(
		'work' => $row['work_phone_area'].'-'.$row['work_phone'], 
		'mobile' => $row['other_phone_area'].'-'.$row['other_phone'], 
		'home' => $row['home_phone_area'].'-'.$row['home_phone']
	);
	
	$qk = array_keys($queue);
	
	while(count($qk) > 0)
	{
		$k = array_shift($qk);
		
		if ($queue[$k] != '-')
		{
			$data['p1'] = $queue[$k];
			$data['p1t'] = $k;
			break;
		}
	}
	
	while(count($qk) > 0)
	{
		$k = array_shift($qk);
		
		if ($queue[$k] != '-')
		{
			$data['p2'] = $queue[$k];
			$data['p2t'] = $k;
			break;
		}
	}
	
	//second number	
	echo '<tr><td>'.$data['p1'].'</td><td>'.$data['p1t'].'</td>';
	echo '<td>'.$data['p2'].'</td><td>'.$data['p2t'].'</td>';
	echo '<td>'.$row['work_phone'].'</td><td>'.$row['other_phone'].'</td>';
	echo '<td>'.$row['home_phone'].'</td>';
	
	
	echo '</tr>';
	
	$mod[$row['uid']] = $data; 
}

/*
 


$y_sum = 0;
$y_cnt = 0;

$y_min = 100000;

while($row = $res->fetch_assoc())
{
	List($addr, $apt) = parse_addr($row['addr1'], $row['addr2']);

	$data = array('uid' => $row['uid'], 'addr' => $addr, 'apt' => $apt);
	
	$data['reg_date'] = Date('Y-m-d', strtotime($row['date_registered']));
	$data['dob'] = Date('Y-m-d', strtotime($row['dob']));
	
	$dob_tmp = preg_replace('#[\s+/]+#', '', $row['dob']);
	
	if (!empty($dob_tmp))
	{	
		$y = Date('Y', strtotime($row['dob']));
		
		if ($y < 2000)
		{
			$y_sum += $y;
			$y_cnt++;
		}		
		
		$y_min = min($y, $y_min);		
	}
	else
	{
		$data['dob'] = '';
	}
	
	echo '<tr><td>'.$addr.'</td><td>'.$apt.'</td><td>'.$row['addr2'].'</td>';
	echo '<td>'.$data['reg_date'].'</td><td>'.$row['date_registered'].'</td>';
	echo '<td>'.$data['dob'].'</td><td>'.$row['dob'].'</td>';
	
	
	echo '</tr>';
	
	$mod[$row['uid']] = $data; 
}

echo 'Avg YOB '.$y_sum / $y_cnt . "<br/>";
echo 'Lowest Y:' . $y_min;

*/


echo '</table>';



foreach($mod as $uid => $info)
{	
	$sql = "UPDATE
				user_import
			SET
				addr = '".addslashes($info['addr'])."',
				apt = '".addslashes($info['apt'])."',
				regdatep = '".addslashes($info['reg_date'])."',
				dobp = '".addslashes($info['dob'])."',
				p1 = '".addslashes($info['p1'])."',
				p1t = '".addslashes($info['p1t'])."',
				p2 = '".addslashes($info['p2'])."',
				p2t = '".addslashes($info['p2t'])."'
			WHERE
				uid = '".$info['uid']."'
				";
	
	$db->query($sql);
}
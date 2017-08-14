<?php
class period{
  var $name; //Employee Name!
  var $per;  //Time Period

  function __construct($name,$per)
  {
    $this->name  = $name;
    $this->per   = $per;
  }

  function get_name()
  {
    return $this->name;
  }
  function get_period()
  {
    return $this->per;
  }
  function get_phase()
  {
    return $this->per[4];
  }
  function get_days(){
    $month   = $this->per[2].$this->per[3];
    $year    = "20".$this->per[0].$this->per[1];
    if($this->per[4]==1)
    {
      $tmp = array(1,16,15);
      return $tmp;
    }
    else if($this->per[4]==2)
    {
      $dayn = cal_days_in_month(CAL_GREGORIAN,$month,$year);
      $tmp = array(16,31,$dayn);
      return $tmp;
    }
  }
  function get_month(){
    $month   = $this->per[2].$this->per[3];
    $year    = "20".$this->per[0].$this->per[1];
    $dateObj = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');
    $tmp = "$monthName $year";
    return $tmp;
  }

  function get_weekend(){
    $year  = "20".$this->per[0].$this->per[1];
    $month = $this->per[2].$this->per[3];
    $weekends = array();
    for($index = 1; $index <=31 ; $index++)
    {
      $tdd = date('l',mktime(0,0,0,$month,$index,$year));
      if(strcasecmp($tdd, "Sunday")==0 || strcasecmp($tdd,"Saturday")==0)
      {
        $weekends[]=$index;
      }
    }
    return $weekends;
  }

  function generate_date()
  {
    $year  = $this->per[0].$this->per[1];
    $month = $this->per[2].$this->per[3];
    $day = $this->per[4];
    if($day==1)
    {
      $tmp = "$month/1/20$year To $month/15/20$year";
      return $tmp;
    }
    else if($day==2)
    {
      $dayn = cal_days_in_month(CAL_GREGORIAN,$month,$year);
      $tmp = "$month/16/20$year To $month/$dayn/20$year";
      return $tmp;
    }
    else
    {
      return "Invalid Data";
    }
  }
}


?>

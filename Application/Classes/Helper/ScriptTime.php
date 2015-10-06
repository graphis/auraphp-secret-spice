<?php

namespace Application\Helper;

class ScriptTime
{
	private $start_time;
	private $stop_time;	
	private $total_time;
	
	public function __construct() { }
	
	private function getmicrotime()
	{
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}
	public function start()
	{
		$this->start_time=$this->getmicrotime();
	}
	
	public function stop()
	{
		$this->stop_time=$this->getmicrotime();		
		$this->total_time=$this->stop_time-$this->start_time;
	}
	
	public function getTime()
	{
		return $this->total_time;
	}
	
}
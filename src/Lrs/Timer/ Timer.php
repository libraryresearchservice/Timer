<?php 

/*
 * This file is part of the LaravelCrosstab package.
 *
 * (c) Library Research Service / Colorado State Library <LRS@lrs.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lrs\Timer;

class Timer {
	
	public $timers = array();
	
	public function __construct($name = false, $start = false) {
		if ( $name ) {
			$this->timers[$name] = array();
			if ( $start ) {
				$this->start($name);	
			}
		}
	}
	
	public function end($name, $fromStart = true) {
		$max = max($this->timers[$name]);
		$end = $this->track($name);
		if ( $fromStart ) {
			$start = min($this->timers[$name]);
		} else {
			$start = $max;	
		}
		return $end - $start;
	}
	
	public function format($microtime) {
		return number_format($microtime, 2);
	}
	
	public function lap($name) {
		return $this->end($name, false);
	}
	
	public function start($name) {
		return $this->track($name);
	}
	
	public function track($name) {
		$time = microtime(true);
		$this->timers[$name][] = $time;
		return $time;
	}
	
}

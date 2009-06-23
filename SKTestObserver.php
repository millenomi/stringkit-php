<?php

class SKTestObserver {
	static $CurrentObserverStack = null;
	
	static function pushObserver(SKTestObserver $observer) {
		if (self::$CurrentObserverStack === null)
			self::$CurrentObserverStack = array();
			
		self::$CurrentObserverStack[] = $observer;
	}
	
	static function currentObserver() {
		if (self::$CurrentObserverStack === null) return null;
		
		return self::$CurrentObserverStack[sizeof(self::$CurrentObserverStack) - 1];
	}
	
	static function popObserver(SKTestObserver $observer) {
		if (!self::currentObserver() || self::currentObserver() !== $observer)
			throw new Exception("Popping incorrect observer off the observer stack");
		
		array_splice(self::$CurrentObserverStack, sizeof(self::$CurrentObserverStack) - 1, 1);
		if (sizeof(self::$CurrentObserverStack) == 0)
			self::$CurrentObserverStack = null;
	}
	
	function push() { self::pushObserver($this); }
	function pop() { self::popObserver($this); }
	
	// ---
	
	public function __construct() {}
	
	private $ObservedEvents = array();
	
	function observeEvent($eventCode, $arguments) {
		$x = $arguments;
		$x['* EventCode'] = $eventCode;
		$this->ObservedEvents[] = $x;
	}
	
	function hasObserved($eventCode, $arguments) {
		$x = $arguments;
		$x['* EventCode'] = $eventCode;
		
		foreach ($this->ObservedEvents as $event) {
			if ($event == $x)
				return true;
		}
		
		return false;
	}
	
	const DidUseFastBufferOfEncodingFastLane = 'DidUseFastBufferOfEncodingFastLane';
	// with arguments: 
	const EncoderObject = 'EncoderObject';
	const EncodingName = 'EncodingName';
	const StringObject = 'StringObject';
}

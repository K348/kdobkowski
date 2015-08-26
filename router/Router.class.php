<?php
abstract class Router
{
	protected $uri = array();

	abstract protected function compareAddresses();
	abstract protected function getArguments($address_id);

	public function __construct()
	{
		$this->uri['uri'] = $_SERVER['REQUEST_URI'];
	}

	protected function prepareURI()
	{
		if(preg_match('/^(\/(\w+))*(\/)?$/', $this->uri['uri']))
		{
			$this->uri['uri'] = strtolower($this->uri['uri']);
			$this->uri['uri'] = trim($this->uri['uri'], '/');
			$this->uri['parts'] = explode('/', $this->uri['uri']);
			return true;
		}
		return false;
	}

	protected function startController()
	{
		if($this->prepareURI())
			$this->getArguments($this->compareAddresses());
	}

	public function test()
	{
		$this->startController();
	}
}

class RouterConfig extends Router
{
	private $address = array();
	private $address_amount = 0;
	public $_ARGUMENT = array();



	public function compareAddresses()
	{

		$correct_addresses = array();
		$elements = count($this->uri['parts']);

		// SZUKANIE
		for($i = 0; $i < $this->address_amount; $i++)
			if(count($this->address['address'][$i]) == $elements)
					if(($this->address['address'][$i][0] == $this->uri['parts'][0]) || ($this->address['address'][$i][0][0] == '+'))
						$correct_addresses[] = $i;

		for($i = 1; $i < $elements; $i++)
		{
			$a = count($correct_addresses);
			for($j = 0; $j < $a; $j++)
				if($this->address['address'][$correct_addresses[$j]][$i][0] != '+')
					if($this->address['address'][$correct_addresses[$j]][$i] != $this->uri['parts'][$i])
						unset($correct_addresses[$j]);
			$correct_addresses = array_values($correct_addresses);
		}
		// KONIEC SZUKANIA

		if(isset($correct_addresses[0]))
			echo $correct_addresses[0];
		else
			return false;
	}

	public function getArguments($address_id)
	{
		foreach($this->address['address'][$address_id] as $id => $part)
			if($part[0] == '+')
				$this->_ARGUMENT[substr($part, 1)] = $this->uri['parts'][$id];
	}



	/*private function _sort($array = array())
	{
		$result = array();
		foreach($array as $temp)
			$result[] = $temp;
		return $result;
	}*/

	public function addAddress($address = array(), $method, $action)
	{
		$this->address['address'][] = $address;
		$this->address['method'][] = $method;
		$this->address['action'][] = $action;
		$this->address_amount++;
	}

}
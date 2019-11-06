class StringParser_Node_Text
!!!247682.php!!!	__construct(in content : , in occurredAt :  = -1)
		parent::__construct ($occurredAt);
		$this->content = $content;
!!!247810.php!!!	appendText(in text : )
		$this->content .= $text;
!!!247938.php!!!	setFlag(in name : , in value : )
		$this->_flags[$name] = $value;
		return true;
!!!248066.php!!!	getFlag(in flag : , in type :  = 'mixed', in default :  = null)
		if (!isset ($this->_flags[$flag])) {
			return $default;
		}
		$return = $this->_flags[$flag];
		if ($type != 'mixed') {
			settype ($return, $type);
		}
		return $return;
!!!248194.php!!!	_dumpToString()
		return "text \"".substr (preg_replace ('/\s+/', ' ', $this->content), 0, 40)."\" [f:".preg_replace ('/\s+/', ' ', join(':', array_keys ($this->_flags)))."]";

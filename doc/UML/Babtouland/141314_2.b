class StringParser_Node_Text
!!!197634.php!!!	__construct(in content : , in occurredAt :  = -1)
		parent::__construct ($occurredAt);
		$this->content = $content;
!!!197762.php!!!	appendText(in text : )
		$this->content .= $text;
!!!197890.php!!!	setFlag(in name : , in value : )
		$this->_flags[$name] = $value;
		return true;
!!!198018.php!!!	getFlag(in flag : , in type :  = 'mixed', in default :  = null)
		if (!isset ($this->_flags[$flag])) {
			return $default;
		}
		$return = $this->_flags[$flag];
		if ($type != 'mixed') {
			settype ($return, $type);
		}
		return $return;
!!!198146.php!!!	_dumpToString()
		return "text \"".substr (preg_replace ('/\s+/', ' ', $this->content), 0, 40)."\" [f:".preg_replace ('/\s+/', ' ', join(':', array_keys ($this->_flags)))."]";

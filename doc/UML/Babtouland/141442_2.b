class StringParser_BBCode
!!!198274.php!!!	addCode(in name : , in callback_type : , in callback_func : , in callback_params : , in content_type : , in allowed_within : , in not_allowed_within : )
		if (isset ($this->_codes[$name])) {
			return false; // already exists
		}
		if (!preg_match ('/^[a-zA-Z0-9*_!+-]+$/', $name)) {
			return false; // invalid
		}
		$this->_codes[$name] = array (
			'name' => $name,
			'callback_type' => $callback_type,
			'callback_func' => $callback_func,
			'callback_params' => $callback_params,
			'content_type' => $content_type,
			'allowed_within' => $allowed_within,
			'not_allowed_within' => $not_allowed_within,
			'flags' => array ()
		);
		return true;
!!!198402.php!!!	removeCode(in name : )
		if (isset ($this->_codes[$name])) {
			unset ($this->_codes[$name]);
			return true;
		}
		return false;
!!!198530.php!!!	removeAllCodes()
		$this->_codes = array ();
!!!198658.php!!!	setCodeFlag(in name : , in flag : , in value : )
		if (!isset ($this->_codes[$name])) {
			return false;
		}
		$this->_codes[$name]['flags'][$flag] = $value;
		return true;
!!!198786.php!!!	setOccurrenceType(in code : , in type : )
		return $this->setCodeFlag ($code, 'occurrence_type', $type);
!!!198914.php!!!	setMaxOccurrences(in type : , in count : )
		settype ($count, 'integer');
		if ($count < 0) { // sorry, does not make any sense
			return false;
		}
		$this->_maxOccurrences[$type] = $count;
		return true;
!!!199042.php!!!	addParser(in type : , in parser : )
		if (is_array ($type)) {
			foreach ($type as $t) {
				$this->addParser ($t, $parser);
			}
			return true;
		}
		if (!isset ($this->_parsers[$type])) {
			$this->_parsers[$type] = array ();
		}
		$this->_parsers[$type][] = $parser;
		return true;
!!!199170.php!!!	setRootContentType(in content_type : )
		$this->_rootContentType = $content_type;
!!!199298.php!!!	setRootParagraphHandling(in enabled : )
		$this->_rootParagraphHandling = (bool)$enabled;
!!!199426.php!!!	setParagraphHandlingParameters(in detect_string : , in start_tag : , in end_tag : )
		$this->_paragraphHandling = array (
			'detect_string' => $detect_string,
			'start_tag' => $start_tag,
			'end_tag' => $end_tag
		);
!!!199554.php!!!	setGlobalCaseSensitive(in caseSensitive : )
		$this->_caseSensitive = (bool)$caseSensitive;
!!!199682.php!!!	globalCaseSensitive()
		return $this->_caseSensitive;
!!!199810.php!!!	setMixedAttributeTypes(in mixedAttributeTypes : )
		$this->_mixedAttributeTypes = (bool)$mixedAttributeTypes;
!!!199938.php!!!	mixedAttributeTypes()
		return $this->_mixedAttributeTypes;
!!!200066.php!!!	setValidateAgain(in validateAgain : )
		$this->_validateAgain = (bool)$validateAgain;
!!!200194.php!!!	validateAgain()
		return $this->_validateAgain;
!!!200322.php!!!	getCodeFlag(in name : , in flag : , in type :  = 'mixed', in default :  = null)
		if (!isset ($this->_codes[$name])) {
			return $default;
		}
		if (!array_key_exists ($flag, $this->_codes[$name]['flags'])) {
			return $default;
		}
		$return = $this->_codes[$name]['flags'][$flag];
		if ($type != 'mixed') {
			settype ($return, $type);
		}
		return $return;
!!!200450.php!!!	_setStatus(in status : )
		switch ($status) {
			case 0:
				$this->_charactersSearch = array ('[/', '[');
				$this->_status = $status;
				break;
			case 1:
				$this->_charactersSearch = array (']', ' = "', '="', ' = \'', '=\'', ' = ', '=', ': ', ':', ' ');
				$this->_status = $status;
				break;
			case 2:
				$this->_charactersSearch = array (']');
				$this->_status = $status;
				$this->_savedName = '';
				break;
			case 3:
				if ($this->_quoting !== null) {
					if ($this->_mixedAttributeTypes) {
						$this->_charactersSearch = array ('\\\\', '\\'.$this->_quoting, $this->_quoting.' ', $this->_quoting.']', $this->_quoting);
					} else {
						$this->_charactersSearch = array ('\\\\', '\\'.$this->_quoting, $this->_quoting.']', $this->_quoting);
					}
					$this->_status = $status;
					break;
				}
				if ($this->_mixedAttributeTypes) {
					$this->_charactersSearch = array (' ', ']');
				} else {
					$this->_charactersSearch = array (']');
				}
				$this->_status = $status;
				break;
			case 4:
				$this->_charactersSearch = array (' ', ']', '="', '=\'', '=');
				$this->_status = $status;
				$this->_savedName = '';
				$this->_savedValue = '';
				break;
			case 5:
				if ($this->_quoting !== null) {
					$this->_charactersSearch = array ('\\\\', '\\'.$this->_quoting, $this->_quoting.' ', $this->_quoting.']', $this->_quoting);
				} else {
					$this->_charactersSearch = array (' ', ']');
				}
				$this->_status = $status;
				$this->_savedValue = '';
				break;
			case 7:
				$this->_charactersSearch = array ('[/'.$this->_topNode ('name').']');
				if (!$this->_topNode ('getFlag', 'case_sensitive', 'boolean', true) || !$this->_caseSensitive) {
					$this->_charactersSearch[] = '[/';
				}
				$this->_status = $status;
				break;
			default:
				return false;
		}
		return true;
!!!200578.php!!!	_appendText(in text : )
		if (!strlen ($text)) {
			return true;
		}
		switch ($this->_status) {
			case 0:
			case 7:
				return $this->_appendToLastTextChild ($text);
			case 1:
				return $this->_topNode ('appendToName', $text);
			case 2:
			case 4:
				$this->_savedName .= $text;
				return true;
			case 3:
				return $this->_topNode ('appendToAttribute', 'default', $text);
			case 5:
				$this->_savedValue .= $text;
				return true;
			default:
				return false;
		}
!!!200706.php!!!	_reparseAfterCurrentBlock()
		if ($this->_status == 2) {
			// this status will *never* call _reparseAfterCurrentBlock itself
			// so this is called if the loop ends
			// therefore, just add the [/ to the text
			
			// _savedName should be empty but just in case
			$this->_cpos -= strlen ($this->_savedName);
			$this->_savedName = '';
			$this->_status = 0;
			$this->_appendText ('[/');
			return true;
		} else {
			return parent::_reparseAfterCurrentBlock ();
		}
!!!200834.php!!!	_applyParsers(in type : , in text : )
		if (!isset ($this->_parsers[$type])) {
			return $text;
		}
		foreach ($this->_parsers[$type] as $parser) {
			if (is_callable ($parser)) {
				$ntext = call_user_func ($parser, $text);
				if (is_string ($ntext)) {
					$text = $ntext;
				}
			}
		}
		return $text;
!!!200962.php!!!	_handleStatus(in status : , in needle : )
		switch ($status) {
			case 0: // NORMAL TEXT
				if ($needle != '[' && $needle != '[/') {
					$this->_appendText ($needle);
					return true;
				}
				if ($needle == '[') {
					$node = new StringParser_BBCode_Node_Element ($this->_cpos);
					$res = $this->_pushNode ($node);
					if (!$res) {
						return false;
					}
					$this->_setStatus (1);
				} else if ($needle == '[/') {
					if (count ($this->_stack) <= 1) {
						$this->_appendText ($needle);
						return true;
					}
					$this->_setStatus (2);
				}
				break;
			case 1: // OPEN TAG
				if ($needle == ']') {
					return $this->_openElement (0);
				} else if (trim ($needle) == ':' || trim ($needle) == '=') {
					$this->_quoting = null;
					$this->_setStatus (3); // default value parser
					break;
				} else if (trim ($needle) == '="' || trim ($needle) == '= "' || trim ($needle) == '=\'' || trim ($needle) == '= \'') {
					$this->_quoting = substr (trim ($needle), -1);
					$this->_setStatus (3); // default value parser with quotation
					break;
				} else if ($needle == ' ') {
					$this->_setStatus (4); // attribute parser
					break;
				} else {
					$this->_appendText ($needle);
					return true;
				}
				// break not necessary because every if clause contains return
			case 2: // CLOSE TAG
				if ($needle != ']') {
					$this->_appendText ($needle);
					return true;
				}
				$closecount = 0;
				if (!$this->_isCloseable ($this->_savedName, $closecount)) {
					$this->_setStatus (0);
					$this->_appendText ('[/'.$this->_savedName.$needle);
					return true;
				}
				// this validates the code(s) to be closed after the content tree of
				// that code(s) are built - if the second validation fails, we will have
				// to reparse. note that as _reparseAfterCurrentBlock will not work correctly
				// if we're in $status == 2, we will have to set our status to 0 manually
				if (!$this->_validateCloseTags ($closecount)) {
					$this->_setStatus (0);
					return $this->_reparseAfterCurrentBlock ();
				}
				$this->_setStatus (0);
				for ($i = 0; $i < $closecount; $i++) {
					if ($i == $closecount - 1) {
						$this->_topNode ('setHadCloseTag');
					}
					if (!$this->_popNode ()) {
						return false;
					}
				}
				break;
			case 3: // DEFAULT ATTRIBUTE
				if ($this->_quoting !== null) {
					if ($needle == '\\\\') {
						$this->_appendText ('\\');
						return true;
					} else if ($needle == '\\'.$this->_quoting) {
						$this->_appendText ($this->_quoting);
						return true;
					} else if ($needle == $this->_quoting.' ') {
						$this->_setStatus (4);
						return true;
					} else if ($needle == $this->_quoting.']') {
						return $this->_openElement (2);
					} else if ($needle == $this->_quoting) {
						// can't be, only ']' and ' ' allowed after quoting char
						return $this->_reparseAfterCurrentBlock ();
					} else {
						$this->_appendText ($needle);
						return true;
					}
				} else {
					if ($needle == ' ') {
						$this->_setStatus (4);
						return true;
					} else if ($needle == ']') {
						return $this->_openElement (2);
					} else {
						$this->_appendText ($needle);
						return true;
					}
				}
				// break not needed because every if clause contains return!
			case 4: // ATTRIBUTE NAME
				if ($needle == ' ') {
					if (strlen ($this->_savedName)) {
						$this->_topNode ('setAttribute', $this->_savedName, true);
					}
					// just ignore and continue in same mode
					$this->_setStatus (4); // reset parameters
					return true;
				} else if ($needle == ']') {
					if (strlen ($this->_savedName)) {
						$this->_topNode ('setAttribute', $this->_savedName, true);
					}
					return $this->_openElement (2);
				} else if ($needle == '=') {
					$this->_quoting = null;
					$this->_setStatus (5);
					return true;
				} else if ($needle == '="') {
					$this->_quoting = '"';
					$this->_setStatus (5);
					return true;
				} else if ($needle == '=\'') {
					$this->_quoting = '\'';
					$this->_setStatus (5);
					return true;
				} else {
					$this->_appendText ($needle);
					return true;
				}
				// break not needed because every if clause contains return!
			case 5: // ATTRIBUTE VALUE
				if ($this->_quoting !== null) {
					if ($needle == '\\\\') {
						$this->_appendText ('\\');
						return true;
					} else if ($needle == '\\'.$this->_quoting) {
						$this->_appendText ($this->_quoting);
						return true;
					} else if ($needle == $this->_quoting.' ') {
						$this->_topNode ('setAttribute', $this->_savedName, $this->_savedValue);
						$this->_setStatus (4);
						return true;
					} else if ($needle == $this->_quoting.']') {
						$this->_topNode ('setAttribute', $this->_savedName, $this->_savedValue);
						return $this->_openElement (2);
					} else if ($needle == $this->_quoting) {
						// can't be, only ']' and ' ' allowed after quoting char
						return $this->_reparseAfterCurrentBlock ();
					} else {
						$this->_appendText ($needle);
						return true;
					}
				} else {
					if ($needle == ' ') {
						$this->_topNode ('setAttribute', $this->_savedName, $this->_savedValue);
						$this->_setStatus (4);
						return true;
					} else if ($needle == ']') {
						$this->_topNode ('setAttribute', $this->_savedName, $this->_savedValue);
						return $this->_openElement (2);
					} else {
						$this->_appendText ($needle);
						return true;
					}
				}
				// break not needed because every if clause contains return!
			case 7:
				if ($needle == '[/') {
					// this was case insensitive match
					if (strtolower (substr ($this->_text, $this->_cpos + strlen ($needle), strlen ($this->_topNode ('name')) + 1)) == strtolower ($this->_topNode ('name').']')) {
						// this matched
						$this->_cpos += strlen ($this->_topNode ('name')) + 1;
					} else {
						// it didn't match
						$this->_appendText ($needle);
						return true;
					}
				}
				$closecount = $this->_savedCloseCount;
				if (!$this->_topNode ('validate')) {
					return $this->_reparseAfterCurrentBlock ();
				}
				// do we have to close subnodes?
				if ($closecount) {
					// get top node
					$mynode = $this->_stack[count ($this->_stack)-1];
					// close necessary nodes
					for ($i = 0; $i <= $closecount; $i++) {
						if (!$this->_popNode ()) {
							return false;
						}
					}
					if (!$this->_pushNode ($mynode)) {
						return false;
					}
				}
				$this->_setStatus (0);
				$this->_popNode ();
				return true;
			default: 
				return false;
		}
		return true;
!!!201090.php!!!	_openElement(in type :  = 0)
		$name = $this->_getCanonicalName ($this->_topNode ('name'));
		if ($name === false) {
			return $this->_reparseAfterCurrentBlock ();
		}
		$occ_type = $this->getCodeFlag ($name, 'occurrence_type', 'string');
		if ($occ_type !== null && isset ($this->_maxOccurrences[$occ_type])) {
			$max_occs = $this->_maxOccurrences[$occ_type];
			$occs = $this->_root->getNodeCountByCriterium ('flag:occurrence_type', $occ_type);
			if ($occs >= $max_occs) {
				return $this->_reparseAfterCurrentBlock ();
			}
		}
		$closecount = 0;
		$this->_topNode ('setCodeInfo', $this->_codes[$name]);
		if (!$this->_isOpenable ($name, $closecount)) {
			return $this->_reparseAfterCurrentBlock ();
		}
		$this->_setStatus (0);
		switch ($type) {
		case 0:
			$cond = $this->_isUseContent ($this->_stack[count($this->_stack)-1], false);
			break;
		case 1:
			$cond = $this->_isUseContent ($this->_stack[count($this->_stack)-1], true);
			break;
		case 2:
			$cond = $this->_isUseContent ($this->_stack[count($this->_stack)-1], true);
			break;
		default:
			$cond = false;
			break;
		}
		if ($cond) {
			$this->_savedCloseCount = $closecount;
			$this->_setStatus (7);
			return true;
		}
		if (!$this->_topNode ('validate')) {
			return $this->_reparseAfterCurrentBlock ();
		}
		// do we have to close subnodes?
		if ($closecount) {
			// get top node
			$mynode = $this->_stack[count ($this->_stack)-1];
			// close necessary nodes
			for ($i = 0; $i <= $closecount; $i++) {
				if (!$this->_popNode ()) {
					return false;
				}
			}
			if (!$this->_pushNode ($mynode)) {
				return false;
			}
		}
		
		if ($this->_codes[$name]['callback_type'] == 'simple_replace_single' || $this->_codes[$name]['callback_type'] == 'callback_replace_single') {
			if (!$this->_popNode ())  {
				return false;
			}
		}
		
		return true;
!!!201218.php!!!	_isCloseable(in name : , inout closecount : )
		$node = $this->_findNamedNode ($name, false);
		if ($node === false) {
			return false;
		}
		$scount = count ($this->_stack);
		for ($i = $scount - 1; $i > 0; $i--) {
			$closecount++;
			if ($this->_stack[$i]->equals ($node)) {
				return true;
			}
			if ($this->_stack[$i]->getFlag ('closetag', 'integer', BBCODE_CLOSETAG_IMPLICIT) == BBCODE_CLOSETAG_MUSTEXIST) {
				return false;
			}
		}
		return false;
!!!201346.php!!!	_validateCloseTags(in closecount : )
		$scount = count ($this->_stack);
		for ($i = $scount - 1; $i >= $scount - $closecount; $i--) {
			if ($this->_validateAgain) {
				if (!$this->_stack[$i]->validate ('validate_again')) {
					return false;
				}
			}
		}
		return true;
!!!201474.php!!!	_isOpenable(in name : , inout closecount : )
		if (!isset ($this->_codes[$name])) {
			return false;
		}
		
		$closecount = 0;
		
		$allowed_within = $this->_codes[$name]['allowed_within'];
		$not_allowed_within = $this->_codes[$name]['not_allowed_within'];
		
		$scount = count ($this->_stack);
		if ($scount == 2) { // top level element
			if (!in_array ($this->_rootContentType, $allowed_within)) {
				return false;
			}
		} else {
			if (!in_array ($this->_stack[$scount-2]->_codeInfo['content_type'], $allowed_within)) {
				return $this->_isOpenableWithClose ($name, $closecount);
			}
		}
		
		for ($i = 1; $i < $scount - 1; $i++) {
			if (in_array ($this->_stack[$i]->_codeInfo['content_type'], $not_allowed_within)) {
				return $this->_isOpenableWithClose ($name, $closecount);
			}
		}
		
		return true;
!!!201602.php!!!	_isOpenableWithClose(in name : , inout closecount : )
		$tnname = $this->_getCanonicalName ($this->_topNode ('name'));
		if (!in_array ($this->getCodeFlag ($tnname, 'closetag', 'integer', BBCODE_CLOSETAG_IMPLICIT), array (BBCODE_CLOSETAG_FORBIDDEN, BBCODE_CLOSETAG_OPTIONAL))) {
			return false;
		}
		$node = $this->_findNamedNode ($name, true);
		if ($node === false) {
			return false;
		}
		$scount = count ($this->_stack);
		if ($scount < 3) {
			return false;
		}
		for ($i = $scount - 2; $i > 0; $i--) {
			$closecount++;
			if ($this->_stack[$i]->equals ($node)) {
				return true;
			}
			if (in_array ($this->_stack[$i]->getFlag ('closetag', 'integer', BBCODE_CLOSETAG_IMPLICIT), array (BBCODE_CLOSETAG_IMPLICIT_ON_CLOSE_ONLY, BBCODE_CLOSETAG_MUSTEXIST))) {
				return false;
			}
			if ($this->_validateAgain) {
				if (!$this->_stack[$i]->validate ('validate_again')) {
					return false;
				}
			}
		}
		
		return false;
!!!201730.php!!!	_closeRemainingBlocks()
		// everything closed
		if (count ($this->_stack) == 1) {
			return true;
		}
		// not everything close
		if ($this->strict) {
			return false;
		}
		while (count ($this->_stack) > 1) {
			if ($this->_topNode ('getFlag', 'closetag', 'integer', BBCODE_CLOSETAG_IMPLICIT) == BBCODE_CLOSETAG_MUSTEXIST) {
				return false; // sorry
			}
			$res = $this->_popNode ();
			if (!$res) {
				return false;
			}
		}
		return true;
!!!201858.php!!!	_findNamedNode(in name : , in searchdeeper :  = false)
		$lname = $this->_getCanonicalName ($name);
		$case_sensitive = $this->_caseSensitive && $this->getCodeFlag ($lname, 'case_sensitive', 'boolean', true);
		if ($case_sensitive) {
			$name = strtolower ($name);
		}
		$scount = count ($this->_stack);
		if ($searchdeeper) {
			$scount--;
		}
		for ($i = $scount - 1; $i > 0; $i--) {
			if (!$case_sensitive) {
				$cmp_name = strtolower ($this->_stack[$i]->name ());
			} else {
				$cmp_name = $this->_stack[$i]->name ();
			}
			if ($cmp_name == $lname) {
				return $this->_stack[$i];
			}
		}
		$result = false;
		return $result;
!!!201986.php!!!	_outputTree()
		if ($this->_noOutput) {
			return true;
		}
		$output = $this->_outputNode ($this->_root);
		if (is_string ($output)) {
			$this->_output = $this->_applyPostfilters ($output);
			unset ($output);
			return true;
		}
		
		return false;
!!!202114.php!!!	_outputNode(inout node : )
		$output = '';
		if ($node->_type == STRINGPARSER_BBCODE_NODE_PARAGRAPH || $node->_type == STRINGPARSER_BBCODE_NODE_ELEMENT || $node->_type == STRINGPARSER_NODE_ROOT) {
			$ccount = count ($node->_children);
			for ($i = 0; $i < $ccount; $i++) {
				$suboutput = $this->_outputNode ($node->_children[$i]);
				if (!is_string ($suboutput)) {
					return false;
				}
				$output .= $suboutput;
			}
			if ($node->_type == STRINGPARSER_BBCODE_NODE_PARAGRAPH) {
				return $this->_paragraphHandling['start_tag'].$output.$this->_paragraphHandling['end_tag'];
			}
			if ($node->_type == STRINGPARSER_BBCODE_NODE_ELEMENT) {
				return $node->getReplacement ($output);
			}
			return $output;
		} else if ($node->_type == STRINGPARSER_NODE_TEXT) {
			$output = $node->content;
			$before = '';
			$after = '';
			$ol = strlen ($output);
			switch ($node->getFlag ('newlinemode.begin', 'integer', BBCODE_NEWLINE_PARSE)) {
			case BBCODE_NEWLINE_IGNORE:
				if ($ol && $output{0} == "\n") {
					$before = "\n";
				}
				// don't break!
			case BBCODE_NEWLINE_DROP:
				if ($ol && $output{0} == "\n") {
					$output = substr ($output, 1);
					$ol--;
				}
				break;
			}
			switch ($node->getFlag ('newlinemode.end', 'integer', BBCODE_NEWLINE_PARSE)) {
			case BBCODE_NEWLINE_IGNORE:
				if ($ol && $output{$ol-1} == "\n") {
					$after = "\n";
				}
				// don't break!
			case BBCODE_NEWLINE_DROP:
				if ($ol && $output{$ol-1} == "\n") {
					$output = substr ($output, 0, -1);
					$ol--;
				}
				break;
			}
			// can't do anything
			if ($node->_parent === null) {
				return $before.$output.$after;
			}
			if ($node->_parent->_type == STRINGPARSER_BBCODE_NODE_PARAGRAPH)  {
				$parent = $node->_parent;
				unset ($node);
				$node = $parent;
				unset ($parent);
				// if no parent for this paragraph
				if ($node->_parent === null) {
					return $before.$output.$after;
				}
			}
			if ($node->_parent->_type == STRINGPARSER_NODE_ROOT) {
				return $before.$this->_applyParsers ($this->_rootContentType, $output).$after;
			}
			if ($node->_parent->_type == STRINGPARSER_BBCODE_NODE_ELEMENT) {
				return $before.$this->_applyParsers ($node->_parent->_codeInfo['content_type'], $output).$after;
			}
			return $before.$output.$after;
		}
!!!202242.php!!!	_modifyTree()
		// first pass: try to do newline handling
		$nodes = $this->_root->getNodesByCriterium ('needsTextNodeModification', true);
		$nodes_count = count ($nodes);
		for ($i = 0; $i < $nodes_count; $i++) {
			$v = $nodes[$i]->getFlag ('opentag.before.newline', 'integer', BBCODE_NEWLINE_PARSE);
			if ($v != BBCODE_NEWLINE_PARSE) {
				$n = $nodes[$i]->findPrevAdjentTextNode ();
				if (!is_null ($n)) {
					$n->setFlag ('newlinemode.end', $v);
				}
				unset ($n);
			}
			$v = $nodes[$i]->getFlag ('opentag.after.newline', 'integer', BBCODE_NEWLINE_PARSE);
			if ($v != BBCODE_NEWLINE_PARSE) {
				$n = $nodes[$i]->firstChildIfText ();
				if (!is_null ($n)) {
					$n->setFlag ('newlinemode.begin', $v);
				}
				unset ($n);
			}
			$v = $nodes[$i]->getFlag ('closetag.before.newline', 'integer', BBCODE_NEWLINE_PARSE);
			if ($v != BBCODE_NEWLINE_PARSE) {
				$n = $nodes[$i]->lastChildIfText ();
				if (!is_null ($n)) {
					$n->setFlag ('newlinemode.end', $v);
				}
				unset ($n);
			}
			$v = $nodes[$i]->getFlag ('closetag.after.newline', 'integer', BBCODE_NEWLINE_PARSE);
			if ($v != BBCODE_NEWLINE_PARSE) {
				$n = $nodes[$i]->findNextAdjentTextNode ();
				if (!is_null ($n)) {
					$n->setFlag ('newlinemode.begin', $v);
				}
				unset ($n);
			}
		}
		
		// second pass a: do paragraph handling on root element
		if ($this->_rootParagraphHandling) {
			$res = $this->_handleParagraphs ($this->_root);
			if (!$res) {
				return false;
			}
		}
		
		// second pass b: do paragraph handling on other elements
		unset ($nodes);
		$nodes = $this->_root->getNodesByCriterium ('flag:paragraphs', true);
		$nodes_count = count ($nodes);
		for ($i = 0; $i < $nodes_count; $i++) {
			$res = $this->_handleParagraphs ($nodes[$i]);
			if (!$res) {
				return false;
			}
		}
		
		// second pass c: search for empty paragraph nodes and remove them
		unset ($nodes);
		$nodes = $this->_root->getNodesByCriterium ('empty', true);
		$nodes_count = count ($nodes);
		if (isset ($parent)) {
			unset ($parent); $parent = null;
		}
		for ($i = 0; $i < $nodes_count; $i++) {
			if ($nodes[$i]->_type != STRINGPARSER_BBCODE_NODE_PARAGRAPH) {
				continue;
			}
			unset ($parent);
			$parent = $nodes[$i]->_parent;
			$parent->removeChild ($nodes[$i], true);
		}
		
		return true;
!!!202370.php!!!	_handleParagraphs(inout node : )
		// if this node is already a subnode of a paragraph node, do NOT 
		// do paragraph handling on this node!
		if ($this->_hasParagraphAncestor ($node)) {
			return true;
		}
		$dest_nodes = array ();
		$last_node_was_paragraph = false;
		$prevtype = STRINGPARSER_NODE_TEXT;
		$paragraph = null;
		while (count ($node->_children)) {
			$mynode = $node->_children[0];
			$node->removeChild ($mynode);
			$subprevtype = $prevtype;
			$sub_nodes = $this->_breakupNodeByParagraphs ($mynode);
			for ($i = 0; $i < count ($sub_nodes); $i++) {
				if (!$last_node_was_paragraph ||  ($prevtype == $sub_nodes[$i]->_type && ($i != 0 || $prevtype != STRINGPARSER_BBCODE_NODE_ELEMENT))) {
					unset ($paragraph);
					$paragraph = new StringParser_BBCode_Node_Paragraph ();
				}
				$prevtype = $sub_nodes[$i]->_type;
				if ($sub_nodes[$i]->_type != STRINGPARSER_BBCODE_NODE_ELEMENT || $sub_nodes[$i]->getFlag ('paragraph_type', 'integer', BBCODE_PARAGRAPH_ALLOW_BREAKUP) != BBCODE_PARAGRAPH_BLOCK_ELEMENT) {
					$paragraph->appendChild ($sub_nodes[$i]);
					$dest_nodes[] = $paragraph;
					$last_node_was_paragraph = true;
				} else {
					$dest_nodes[] = $sub_nodes[$i];
					$last_onde_was_paragraph = false;
					unset ($paragraph);
					$paragraph = new StringParser_BBCode_Node_Paragraph ();
				}
			}
		}
		$count = count ($dest_nodes);
		for ($i = 0; $i < $count; $i++) {
			$node->appendChild ($dest_nodes[$i]);
		}
		unset ($dest_nodes);
		unset ($paragraph);
		return true;
!!!202498.php!!!	_hasParagraphAncestor(inout node : )
		if ($node->_parent === null) {
			return false;
		}
		$parent = $node->_parent;
		if ($parent->_type == STRINGPARSER_BBCODE_NODE_PARAGRAPH) {
			return true;
		}
		return $this->_hasParagraphAncestor ($parent);
!!!202626.php!!!	_breakupNodeByParagraphs(inout node : )
		$detect_string = $this->_paragraphHandling['detect_string'];
		$dest_nodes = array ();
		// text node => no problem
		if ($node->_type == STRINGPARSER_NODE_TEXT) {
			$cpos = 0;
			while (($npos = strpos ($node->content, $detect_string, $cpos)) !== false) {
				$subnode = new StringParser_Node_Text (substr ($node->content, $cpos, $npos - $cpos), $node->occurredAt + $cpos);
				// copy flags
				foreach ($node->_flags as $flag => $value) {
					if ($flag == 'newlinemode.begin') {
						if ($cpos == 0) {
							$subnode->setFlag ($flag, $value);
						}
					} else if ($flag == 'newlinemode.end') {
						// do nothing
					} else {
						$subnode->setFlag ($flag, $value);
					}
				}
				$dest_nodes[] = $subnode;
				unset ($subnode);
				$cpos = $npos + strlen ($detect_string);
			}
			$subnode = new StringParser_Node_Text (substr ($node->content, $cpos), $node->occurredAt + $cpos);
			if ($cpos == 0) {
				$value = $node->getFlag ('newlinemode.begin', 'integer', null);
				if ($value !== null) {
					$subnode->setFlag ('newlinemode.begin', $value);
				}
			}
			$value = $node->getFlag ('newlinemode.end', 'integer', null);
			if ($value !== null) {
				$subnode->setFlag ('newlinemode.end', $value);
			}
			$dest_nodes[] = $subnode;
			unset ($subnode);
			return $dest_nodes;
		}
		// not a text node or an element node => no way
		if ($node->_type != STRINGPARSER_BBCODE_NODE_ELEMENT) {
			$dest_nodes[] = $node;
			return $dest_nodes;
		}
		if ($node->getFlag ('paragraph_type', 'integer', BBCODE_PARAGRAPH_ALLOW_BREAKUP) != BBCODE_PARAGRAPH_ALLOW_BREAKUP || !count ($node->_children)) {
			$dest_nodes[] = $node;
			return $dest_nodes;
		}
		$dest_node = $node->duplicate ();
		$nodecount = count ($node->_children);
		// now this node allows breakup - do it
		for ($i = 0; $i < $nodecount; $i++) {
			$firstnode = $node->_children[0];
			$node->removeChild ($firstnode);
			$sub_nodes = $this->_breakupNodeByParagraphs ($firstnode);
			for ($j = 0; $j < count ($sub_nodes); $j++) {
				if ($j != 0) {
					$dest_nodes[] = $dest_node;
					unset ($dest_node);
					$dest_node = $node->duplicate ();
				}
				$dest_node->appendChild ($sub_nodes[$j]);
			}
			unset ($sub_nodes);
		}
		$dest_nodes[] = $dest_node;
		return $dest_nodes;
!!!202754.php!!!	_isUseContent(inout node : , in check_attrs :  = false)
		$name = $this->_getCanonicalName ($node->name ());
		// this should NOT happen
		if ($name === false) {
			return false;
		}
		if ($this->_codes[$name]['callback_type'] == 'usecontent') {
			return true;
		}
		$result = false;
		if ($this->_codes[$name]['callback_type'] == 'callback_replace?') {
			$result = true;
		} else if ($this->_codes[$name]['callback_type'] != 'usecontent?') {
			return false;
		}
		if ($check_attrs === false) {
			return !$result;
		}
		$attributes = array_keys ($this->_topNodeVar ('_attributes'));
		$p = @$this->_codes[$name]['callback_params']['usecontent_param'];
		if (is_array ($p)) {
			foreach ($p as $param) {
				if (in_array ($param, $attributes)) {
					return $result;
				}
			}
		} else {
			if (in_array ($p, $attributes)) {
				return $result;
			}
		}
		return !$result;
!!!202882.php!!!	_getCanonicalName(in name : )
		if (isset ($this->_codes[$name])) {
			return $name;
		}
		$found = false;
		// try to find the code in the code list
		foreach (array_keys ($this->_codes) as $rname) {
			// match
			if (strtolower ($rname) == strtolower ($name)) {
				$found = $rname;
				break;
			}
		}
		if ($found === false || ($this->_caseSensitive && $this->getCodeFlag ($found, 'case_sensitive', 'boolean', true))) {
			return false;
		}
		return $rname;
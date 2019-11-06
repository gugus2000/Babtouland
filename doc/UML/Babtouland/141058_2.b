class StringParser_Node
!!!195202.php!!!	__construct(in occurredAt :  = -1)
		$this->_id = $GLOBALS['__STRINGPARSER_NODE_ID']++;
		$this->occurredAt = $occurredAt;
!!!195330.php!!!	type()
		return $this->_type;
!!!195458.php!!!	prependChild(inout node : )
		if (!is_object ($node)) {
			return false;
		}
		
		// root nodes may not be children of other nodes!
		if ($node->_type == STRINGPARSER_NODE_ROOT) {
			return false;
		}
		
		// if node already has a parent
		if ($node->_parent !== false) {
			// remove node from there
			$parent = $node->_parent;
			if (!$parent->removeChild ($node, false)) {
				return false;
			}
			unset ($parent);
		}
		
		$index = count ($this->_children) - 1;
		// move all nodes to a new index
		while ($index >= 0) {
			// save object
			$object = $this->_children[$index];
			// we have to unset it because else it will be
			// overridden in in the loop
			unset ($this->_children[$index]);
			// put object to new position
			$this->_children[$index+1] = $object;
			$index--;
		}
		$this->_children[0] = $node;
		return true;
!!!195586.php!!!	appendToLastTextChild(in text : )
		$ccount = count ($this->_children);
		if ($ccount == 0 || $this->_children[$ccount-1]->_type != STRINGPARSER_NODE_TEXT) {
			$ntextnode = new StringParser_Node_Text ($text);
			return $this->appendChild ($ntextnode);
		} else {
			$this->_children[$ccount-1]->appendText ($text);
			return true;
		}
!!!195714.php!!!	appendChild(inout node : )
		if (!is_object ($node)) {
			return false;
		}
		
		// root nodes may not be children of other nodes!
		if ($node->_type == STRINGPARSER_NODE_ROOT) {
			return false;
		}
		
		// if node already has a parent
		if ($node->_parent !== null) {
			// remove node from there
			$parent = $node->_parent;
			if (!$parent->removeChild ($node, false)) {
				return false;
			}
			unset ($parent);
		}
		
		// append it to current node
		$new_index = count ($this->_children);
		$this->_children[$new_index] = $node;
		$node->_parent = $this;
		return true;
!!!195842.php!!!	insertChildBefore(inout node : , inout reference : )
		if (!is_object ($node)) {
			return false;
		}
		
		// root nodes may not be children of other nodes!
		if ($node->_type == STRINGPARSER_NODE_ROOT) {
			return false;
		}
		
		// is the reference node a child?
		$child = $this->_findChild ($reference);
		
		if ($child === false) {
			return false;
		}
		
		// if node already has a parent
		if ($node->_parent !== null) {
			// remove node from there
			$parent = $node->_parent;
			if (!$parent->removeChild ($node, false)) {
				return false;
			}
			unset ($parent);
		}
		
		$index = count ($this->_children) - 1;
		// move all nodes to a new index
		while ($index >= $child) {
			// save object
			$object = $this->_children[$index];
			// we have to unset it because else it will be
			// overridden in in the loop
			unset ($this->_children[$index]);
			// put object to new position
			$this->_children[$index+1] = $object;
			$index--;
		}
		$this->_children[$child] = $node;
		return true;
!!!195970.php!!!	insertChildAfter(inout node : , inout reference : )
		if (!is_object ($node)) {
			return false;
		}
		
		// root nodes may not be children of other nodes!
		if ($node->_type == STRINGPARSER_NODE_ROOT) {
			return false;
		}
		
		// is the reference node a child?
		$child = $this->_findChild ($reference);
		
		if ($child === false) {
			return false;
		}
		
		// if node already has a parent
		if ($node->_parent !== false) {
			// remove node from there
			$parent = $node->_parent;
			if (!$parent->removeChild ($node, false)) {
				return false;
			}
			unset ($parent);
		}
		
		$index = count ($this->_children) - 1;
		// move all nodes to a new index
		while ($index >= $child + 1) {
			// save object
			$object = $this->_children[$index];
			// we have to unset it because else it will be
			// overridden in in the loop
			unset ($this->_children[$index]);
			// put object to new position
			$this->_children[$index+1] = $object;
			$index--;
		}
		$this->_children[$child + 1] = $node;
		return true;
!!!196098.php!!!	removeChild(inout child : , in destroy :  = false)
		if (is_object ($child)) {
			// if object: get index
			$object = $child;
			unset ($child);
			$child = $this->_findChild ($object);
			if ($child === false) {
				return false;
			}
		} else {
			// remove reference on $child
			$save = $child;
			unset($child);
			$child = $save;
			
			// else: get object
			if (!isset($this->_children[$child])) {
				return false;
			}
			$object = $this->_children[$child];
		}
		
		// store count for later use
		$ccount = count ($this->_children);
		
		// index out of bounds
		if (!is_int ($child) || $child < 0 || $child >= $ccount) {
			return false;
		}
		
		// inkonsistency
		if ($this->_children[$child]->_parent === null ||
		    $this->_children[$child]->_parent->_id != $this->_id) {
			return false;
		}
		
		// $object->_parent = null would equal to $this = null
		// as $object->_parent is a reference to $this!
		// because of this, we have to unset the variable to remove
		// the reference and then redeclare the variable
		unset ($object->_parent); $object->_parent = null;
		
		// we have to unset it because else it will be overridden in
		// in the loop
		unset ($this->_children[$child]);
		
		// move all remaining objects one index higher
		while ($child < $ccount - 1) {
			// save object
			$obj = $this->_children[$child+1];
			// we have to unset it because else it will be
			// overridden in in the loop
			unset ($this->_children[$child+1]);
			// put object to new position
			$this->_children[$child] = $obj;
			// UNSET THE OBJECT!
			unset ($obj);
			$child++;
		}
		
		if ($destroy) {
			return StringParser_Node::destroyNode ($object);
			unset ($object);
		}
		return true;
!!!196226.php!!!	firstChild()
		$ret = null;
		if (!count ($this->_children)) {
			return $ret;
		}
		return $this->_children[0];
!!!196354.php!!!	lastChild()
		$ret = null;
		$c = count ($this->_children);
		if (!$c) {
			return $ret;
		}
		return $this->_children[$c-1];
!!!196482.php!!!	destroyNode(inout node : )
		if ($node === null) {
			return false;
		}
		// if parent exists: remove node from tree!
		if ($node->_parent !== null) {
			$parent = $node->_parent;
			// directly return that result because the removeChild
			// method will call destroyNode again
			return $parent->removeChild ($node, true);
		}
		
		// node has children
		while (count ($node->_children)) {
			$child = 0;
			// remove first child until no more children remain
			if (!$node->removeChild ($child, true)) {
				return false;
			}
			unset($child);
		}
		
		// now call the nodes destructor
		if (!$node->_destroy ()) {
			return false;
		}
		
		// now just unset it and prey that there are no more references
		// to this node
		unset ($node);
		
		return true;
!!!196610.php!!!	_destroy()
		return true;
!!!196738.php!!!	_findChild(inout child : )
		if (!is_object ($child)) {
			return false;
		}
		
		$ccount = count ($this->_children);
		for ($i = 0; $i < $ccount; $i++) {
			if ($this->_children[$i]->_id == $child->_id) {
				return $i;
			}
		}
		
		return false;
!!!196866.php!!!	equals(inout node : )
		return ($this->_id == $node->_id);
!!!196994.php!!!	matchesCriterium(in criterium : , in value : )
		return false;
!!!197122.php!!!	getNodesByCriterium(in criterium : , in value : )
		$nodes = array ();
		$node_ctr = 0;
		for ($i = 0; $i < count ($this->_children); $i++) {
			if ($this->_children[$i]->matchesCriterium ($criterium, $value)) {
				$nodes[$node_ctr++] = $this->_children[$i];
			}
			$subnodes = $this->_children[$i]->getNodesByCriterium ($criterium, $value);
			if (count ($subnodes)) {
				$subnodes_count = count ($subnodes);
				for ($j = 0; $j < $subnodes_count; $j++) {
					$nodes[$node_ctr++] = $subnodes[$j];
					unset ($subnodes[$j]);
				}
			}
			unset ($subnodes);
		}
		return $nodes;
!!!197250.php!!!	getNodeCountByCriterium(in criterium : , in value : )
		$node_ctr = 0;
		for ($i = 0; $i < count ($this->_children); $i++) {
			if ($this->_children[$i]->matchesCriterium ($criterium, $value)) {
				$node_ctr++;
			}
			$subnodes = $this->_children[$i]->getNodeCountByCriterium ($criterium, $value);
			$node_ctr += $subnodes;
		}
		return $node_ctr;
!!!197378.php!!!	dump(in prefix :  = " ", in linesep :  = "\n", in level :  = 0)
		$str = str_repeat ($prefix, $level) . $this->_id . ": " . $this->_dumpToString () . $linesep;
		for ($i = 0; $i < count ($this->_children); $i++) {
			$str .= $this->_children[$i]->dump ($prefix, $linesep, $level + 1);
		}
		return $str;
!!!197506.php!!!	_dumpToString()
		if ($this->_type == STRINGPARSER_NODE_ROOT) {
			return "root";
		}
		return (string)$this->_type;

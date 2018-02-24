<?php 

namespace App\Http\Common;

Class Tree{
	protected $list, $html;

	protected $icon = array('│', '├', '└');

	public $parentBegin,$parentEnd,$parentActiveBegin,$child,$childActive;

	public function __construct($list){
		$this->list = $list;
	}

	public function getTree($bootId, $currentId, $parentIds){
		$nstr = '';
		$child = $this->getChild($bootId);
		if(is_array($child)){
			foreach ($child as $item) {
				@extract($item);
				$id = $item['id'];
				if($this->getChild($id)){
					if(array_search($id, $parentIds) !== false){
						eval("\$nstr = \"$this->parentActiveBegin\";");
						$this->html .= $nstr;
					}else{
						eval("\$nstr = \"$this->parentBegin\";");
						$this->html .= $nstr;
					}

					$this->getTree($id, $currentId, $parentIds);
					eval("\$nstr = \"$this->parentEnd\";");
					$this->html .= $nstr;
				}else{
					if($id == $currentId || array_search($id, $parentIds) !== false){
						eval("\$nstr = \"$this->childActive\";");
						$this->html .= $nstr;
					}else{
						eval("\$nstr = \"$this->child\";");
						$this->html .= $nstr;
					}
				}
			}
		}
		return $this->html;
	}

	public function getChild($bootId){
		$newArr = [];
		foreach ($this->list as $item) {
			if($item['parent_id'] == $bootId){
				array_push($newArr, $item);
			}
		}
		return $newArr ? $newArr : false;
	}
}
<?php
namespace App\Http\Common;

/**
 * 通用的树型类
 */
class Tree
{
    protected $arr = [];
    protected $prefixs = ['│', '├', '└'];
    protected $nbsp = '&nbsp;&nbsp;&nbsp;';

    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function getTree($bootId, $selected, $parentSelected = false){
        $tree = [];
        
        $this->convertTree($bootId, $selected, $tree, 0, $parentSelected);

        return $tree;
    }

    protected function convertTree($bootId, $selected, &$boots, $level, $parentSelected = false){
        $boots = $this->getChild($bootId);
        $hasSelected = false;
        foreach ($boots as $key => $value) {
            $childs = [];
            if(($this->convertTree($value['id'], $selected, $childs, $level + 1) && $parentSelected) ||
                (is_array($selected) ? in_array($value['id'], $selected) : $value['id'] == $selected)){
                $hasSelected = $boots[$key]['selected'] = true;
            }
            $boots[$key]['child'] = $childs;
            $boots[$key]['level'] = $level;
        }
        return $hasSelected;
    }

    public function getSelectTree($bootId, $selected, &$arr=[], $prefix='', $level = 0){
        $boots = $this->getChild($bootId);
        $maxCount = count($boots);
        $index = 1;
        $addon = '';
        foreach ($boots as $key => $value) {
            $value['selected'] = ($value['id'] == $selected);
            if($level === 0){
                $value['prefix'] = $prefix;
            }else{
                if($index < $maxCount){
                    $value['prefix'] = $prefix . $this->prefixs[1];
                    $addon = $this->prefixs[0];
                }else{
                    $value['prefix'] = $prefix . $this->prefixs[2];
                    $addon = $this->nbsp;
                }
            }
            array_push($arr, $value);
            $this->getSelectTree($value['id'], $selected, $arr, $prefix.$addon, $level + 1);
            $index++;
        }
        return $arr;
    }

    protected function getChild($bootId){
        $child = [];
        foreach ($this->arr as $value) {
            if($value['parent_id'] == $bootId){
                array_push($child, $value);
            }
        }
        return $child;
    }
}
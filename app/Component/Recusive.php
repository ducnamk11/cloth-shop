<?php

namespace App\Component;


class Recusive
{
    private $data;
    private $htmlSelect = '';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function CategoryRecusive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if (!empty($parentId) && $parentId == $value['id']) {
                    $this->htmlSelect .= '<option selected value="' . $value['id'] . '">' . $text . $value['name'] . '</option>';
                } else {
                    $this->htmlSelect .= '<option value="' . $value['id'] . '">' . $text . $value['name'] . '</option>';
                }
                $this->CategoryRecusive($parentId, $value['id'], $text . '- ');
            }
        }
        return $this->htmlSelect;
    }

    public function CategoryRecusiveMenu($parentId, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == 0) { // damnh mục cha
                $this->htmlSelect .= '
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a href="category/' . $value['id'] . '"> ' . $value['name'] . '</a>
                                        <a  data-toggle="collapse" data-parent="#accordian" href="#' . $value['slug'] . '">
                                            <span  class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        </a>
                                    </h4>
                               </div>
                               <div id="' . $value['slug'] . '" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>';
                                            foreach ($this->data as $value1) { // danh mục thứ 2
                                                if ($value1['parent_id'] == $value['id']) {
                                                    $this->htmlSelect .= '  <li><a href="category/' . $value1['id'] . '">' . $value1['name'] . ' </a></li>  ';
                                                    }
                                            }
                                            $this->htmlSelect .= '
                                        </ul>
                                    </div>
                                </div>';
            }
        }
        return $this->htmlSelect;
    }
}

<?php

namespace App\View\Components;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class InlineEditor extends Component {
    public $updateUrl;
    public Model $item;

    public $name;

    public function __construct($item, $name = '', $maxWidth = 0) {
        $this->item     = $item;
        $this->name     = $name;
        $this->maxWidth = $maxWidth;
    }

    public function setUpdateUrl($url) {
        $this->updateUrl = $url;
    }

    public function render() {
        $style = '';
        if ($this->maxWidth) {
            $style = "max-width: {$this->maxWidth}px";
        }
        return view('components.inline-editor', [
            'name'      => $this->name,
            'value'     => $this->item->getAttributeValue($this->name),
            'max_width' => $this->maxWidth,
            'style'     => $style,
        ]);
    }
}

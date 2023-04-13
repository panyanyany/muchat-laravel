<?php

namespace App\View\AsComponents;

use Illuminate\View\Component;

class Datetime extends Component {
    public $value;
    public $format;

    public function __construct($value, $format = 'Y-m-d H:i:s') {
        $this->value  = $value;
        $this->format = $format;
    }

    public function render() {
        return $this->value ? date($this->format, strtotime($this->value)) : '';
    }
}

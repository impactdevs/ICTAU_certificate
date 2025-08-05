<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Closure;

class Select extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public array $options = [],
        public $selected = null
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $type = 'text',
        public ?string $value = null,
        public ?string $placeholder = null,
        public ?string $label = null,
        public ?string $id = null,
        public ?string $class = null,
        public bool $required = false,
        public bool $disabled = false,
        public int $min = 0,
        public int $max = 0,
    ) {
        // Initialize any properties or perform any setup needed for the component
        $this->name = $this->name ?? '';
        $this->type = $this->type ?? 'text';
        $this->class = $this->class ?? 'form-control';
        $this->id = $this->id ?? $this->name;
        $this->value = $this->value ?? '';
        $this->placeholder = $this->placeholder ?? '';
        $this->label = $this->label ?? '';
        $this->required = $this->required ?? false;
        $this->disabled = $this->disabled ?? false;
        $this->min = $this->min ?? 0;
        $this->max = $this->max ?? 100;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}

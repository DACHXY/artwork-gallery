<?php

class Component
{
    protected $props;

    public function __construct($props = [])
    {
        $this->props = $props;
    }


    public function render()
    {
        return '';
    }
}

?>
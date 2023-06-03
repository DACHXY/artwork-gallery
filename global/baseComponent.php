<?php

class Component
{
    protected $props;

    public function __construct($props = [])
    {
        $this->props = $props;
    }

    /**
     * 渲染 component
     * 可以複寫
     * @return string
     */
    public function render()
    {
        return '';
    }
}


?>
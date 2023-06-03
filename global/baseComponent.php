<?php

class Component
{
    protected $props;

    public function __construct($props = [])
    {
        $this->props = $props;
    }

    /**
     * 回傳需要渲染的 html
     *
     * @return string
     */
    public function render()
    {
        return '';
    }
}

?>
<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";

class ActionButton extends Component
{
    public function render()
    {
        $href = isset($this->props['href']) ? $this->props['href'] : '';
        $class_name = isset($this->props['className']) ? $this->props['className'] : '';
        $text = isset($this->props['text']) ? $this->props['text'] : '';

        return <<<HTML
            <a class="action-button $class_name" href="$href">
                <div class="line-container">
                    <div class="line"></div>
                    <div class="line__top"></div>
                    <div class="line__bottom"></div>
                </div>
                <span>$text</span>
            </a>
        HTML;
    }
}

?>
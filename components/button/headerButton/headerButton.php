<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";

class HeaderButton extends Component
{
    public function render()
    {
        $text = isset($this->props['text']) ? $this->props['text'] : '';
        $href = isset($this->props['href']) ? $this->props['href'] : '';
        return <<<HTML
            <a class="--header-button" href="$href">
                <div class="--header-button-text">
                    $text
                </div>
            </a>
        HTML;
    }
}


?>
<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";

class Tag extends Component
{
    public function render()
    {
        $icon_props = array(
            "icon" => "tag",
            "className" => "tag-hero"
        );
        $ICON = new Icon($icon_props);

        $text = isset($this->props['text']) ? $this->props['text'] : '';
        $href = isset($this->props['href']) ? $this->props['href'] : '';

        return <<<HTML
            <a class="tag" href="$href">
                {$ICON->render()}
                <span>
                    $text
                </span>
            </a>
        HTML;
    }
}
?>
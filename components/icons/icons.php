<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";

class Icon extends Component
{
    public function render()
    {
        $icon = isset($this->props['icon']) ? $this->props['icon'] : '';
        $class_name = isset($this->props['className']) ? $this->props['className'] : '';
        switch ($icon) {
            case 'logo':
                return <<<HTML
                    <svg class="$class_name" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_13_10)">
                    <path d="M38.0155 37.7405L21.748 4.03408C21.3922 3.2969 20.3498 3.27607 19.9649 3.99846L1.98453 37.7405" stroke="black" stroke-width="5"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_13_10">
                    <rect width="40" height="40" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg>
                HTML;
            default:
                return '';
        }
    }
}
?>
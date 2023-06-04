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

            case 'search':
                return <<<HTML
                <svg class="$class_name" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M796-121 533-384q-30 26-69.959 40.5T378-329q-108.162 0-183.081-75Q120-479 120-585t75-181q75-75 181.5-75t181 75Q632-691 632-584.85 632-542 618-502q-14 40-42 75l264 262-44 44ZM377-389q81.25 0 138.125-57.5T572-585q0-81-56.875-138.5T377-781q-82.083 0-139.542 57.5Q180-666 180-585t57.458 138.5Q294.917-389 377-389Z"/></svg>
                HTML;

            case 'user-default':
                return <<<HTML
                <svg class="$class_name" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.6668 28V25.3333C26.6668 23.9188 26.1049 22.5623 25.1047 21.5621C24.1045 20.5619 22.748 20 21.3335 20H10.6668C9.25234 20 7.89579 20.5619 6.89559 21.5621C5.8954 22.5623 5.3335 23.9188 5.3335 25.3333V28" stroke="#404040" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.9998 14.6667C18.9454 14.6667 21.3332 12.2789 21.3332 9.33333C21.3332 6.38781 18.9454 4 15.9998 4C13.0543 4 10.6665 6.38781 10.6665 9.33333C10.6665 12.2789 13.0543 14.6667 15.9998 14.6667Z" stroke="#404040" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                HTML;

            case 'tag':
                return <<<HTML
                <svg class="$class_name" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_20_17)">
                <path d="M7.09373 20.6854C5.26064 19.6271 4.01619 18.0572 3.36038 15.9757C2.70457 13.8943 3.00628 11.7637 4.26553 9.58398C5.05719 8.21277 6.43514 7.02609 8.39937 6.02395C10.3636 5.0218 12.9369 4.19808 16.1192 3.55279C16.2475 3.53062 16.3819 3.53122 16.5223 3.55459C16.6628 3.57795 16.7908 3.62297 16.9062 3.68964C17.0217 3.7563 17.1247 3.84462 17.2151 3.95459C17.3056 4.06456 17.3733 4.18062 17.4182 4.30279C18.4506 7.38141 19.0239 10.0218 19.1381 12.2239C19.2523 14.4261 18.9136 16.2128 18.1219 17.584C16.8636 19.7635 15.169 21.0899 13.0382 21.5632C10.9074 22.0366 8.92591 21.744 7.09373 20.6854Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_20_17">
                <rect width="24" height="24" fill="white"/>
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
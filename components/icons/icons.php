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
            case 'logout':
                return <<<HTML
                    <svg class="$class_name" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M180-120q-24 0-42-18t-18-42v-600q0-24 18-42t42-18h291v60H180v600h291v60H180Zm486-185-43-43 102-102H375v-60h348L621-612l43-43 176 176-174 174Z"/></svg>
                HTML;
            case "edit":
                return <<<HTML
                    <svg class="$class_name" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M180-180h44l443-443-44-44-443 443v44Zm614-486L666-794l42-42q17-17 42-17t42 17l44 44q17 17 17 42t-17 42l-42 42Zm-42 42L248-120H120v-128l504-504 128 128Zm-107-21-22-22 44 44-22-22Z"/></svg>
                HTML;
            case "add-cart":
                return <<<HTML
                    <svg class="$class_name" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M465-613v-123H341v-60h124v-123h60v123h123v60H525v123h-60ZM289.788-80Q260-80 239-101.212q-21-21.213-21-51Q218-182 239.212-203q21.213-21 51-21Q320-224 341-202.788q21 21.213 21 51Q362-122 340.788-101q-21.213 21-51 21Zm404 0Q664-80 643-101.212q-21-21.213-21-51Q622-182 643.212-203q21.213-21 51-21Q724-224 745-202.788q21 21.213 21 51Q766-122 744.788-101q-21.213 21-51 21ZM290-287q-42 0-61.5-34t.5-69l61-111-150-319H62v-60h116l170 364h292l156-280 52 28-153 277q-9.362 16.667-24.681 25.833Q655-456 634-456H334l-62 109h494v60H290Z"/></svg>
                HTML;

            case "remove-cart":
                return <<<HTML
                    <svg class="$class_name" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M640-452h-35l-59-60h85l126-228H316l-60-60h529q26 0 38 21.5t-2 46.5L680-476q-6 11-15 17.5t-25 6.5ZM286.788-81Q257-81 236-102.212q-21-21.213-21-51Q215-183 236.212-204q21.213-21 51-21Q317-225 338-203.788q21 21.213 21 51Q359-123 337.788-102q-21.213 21-51 21ZM851-35 595-289H277q-38 0-56-27.5t1-59.5l70-117-86-187L46-840l43-43L894-78l-43 43ZM535-349 434-453h-95l-63 104h259Zm96-163h-85 85Zm57 431q-29 0-50.5-21.212-21.5-21.213-21.5-51Q616-183 637.5-204q21.5-21 50.5-21t50.5 21.212q21.5 21.213 21.5 51Q760-123 738.5-102 717-81 688-81Z"/></svg>
                HTML;
            default:
                return '';
        }
    }
}
?>
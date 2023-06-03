<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/button/headerButton/headerButton.php";

class HomePageHeader extends Component
{
    protected function MapButtons($button_text, $button_href)
    {
        $button_props = array(
            "text" => $button_text,
            "href" => $button_href
        );
        $HEADER_BUTTON = new HeaderButton($button_props);

        return $HEADER_BUTTON->render();
    }

    public function render()
    {
        $icon_props = array(
            'icon' => 'logo',
            "className" => "home-header-logo"
        );
        $ICON = new Icon($icon_props);

        $header_buttons = array(
            "HOME" => "/home",
            "GALLERY" => "/gallery",
            "ARTIST" => "/artist"
        );

        $_BUTTONS_ = '';
        foreach ($header_buttons as $button_text => $button_href) {
            $_BUTTONS_ .= $this->MapButtons($button_text, $button_href);
        }

        return <<<HTML
            <div class="frame-home-page-header">
                <div class="frame-header-logo">
                    {$ICON->render()}
                </div>
                <div class="section-header-button">
                    $_BUTTONS_
                </div>
            </div>
        HTML;
    }
}
?>
<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/button/headerButton/headerButton.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/searchBar/searchBar.php";


function MapButtons($button_text, $button_href)
{
    $button_props = array(
        "text" => $button_text,
        "href" => $button_href
    );
    $HEADER_BUTTON = new HeaderButton($button_props);

    return $HEADER_BUTTON->render();
}

class Header extends Component
{
    public function render()
    {
        $icon_props = array(
            'icon' => 'logo',
            "className" => "home-header-logo"
        );
        $ICON = new Icon($icon_props);

        $SEARCHBAR = new GeneralSearchBar();

        $header_buttons = array(
            "HOME" => "/home",
            "GALLERY" => "/gallery",
            "ARTIST" => "/artist"
        );

        $_BUTTONS_ = '';
        foreach ($header_buttons as $button_text => $button_href) {
            $_BUTTONS_ .= MapButtons($button_text, $button_href);
        }

        return <<<HTML
            <div class="frame-header">
                <a href="/home" class="frame-header-logo">
                    {$ICON->render()}
                </a>

                {$SEARCHBAR->render()}
                <div class="section-header-button">
                    $_BUTTONS_
                </div>
                
            </div>
        HTML;
    }
}

class HomePageHeader extends Component
{
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
            $_BUTTONS_ .= MapButtons($button_text, $button_href);
        }

        return <<<HTML
            <div class="frame-home-page-header">
                <a href="/home" class="frame-header-logo">
                    {$ICON->render()}
                </a>
                <div class="section-header-button">
                    $_BUTTONS_
                </div>
                <div class="placeholder">
                </div>
            </div>
        HTML;
    }
}
?>
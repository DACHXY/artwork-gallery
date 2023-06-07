<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";


class GeneralSearchBar extends Component
{

    public function render()
    {

        // Search ICON
        $icon_props = array(
            'icon' => 'search',
            "className" => "main-page-search-icon"
        );
        $ICON = new Icon($icon_props);
        return <<<HTML
            <div class="frame-search">
                {$ICON->render()}
                <form action="/gallery" method="GET">
                    <input class="search-input" type="text" name="keyword"/>
                    <input id="search submit" type="submit" value=""/>
                </form>
            </div>
        HTML;
    }
}

class SearchBar extends Component
{

    public function render()
    {

        // Search ICON
        $icon_props = array(
            'icon' => 'search',
            "className" => "main-page-search-icon"
        );
        $ICON = new Icon($icon_props);
        return <<<HTML
            <div class="section-search">
                <h1 class="search-paraph">Look For Something Cool?</h1>
                <div class="frame-search">
                    {$ICON->render()}
                    <form action="/gallery" method="GET">
                        <input class="search-input" type="text" name="keyword" />
                        <input id="search submit" type="submit" value=""/>
                    </form>
                </div>
            </div>
        HTML;
    }
}

?>
<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";

class Card extends Component
{
    public function render()
    {
        $image_href = isset($this->props['imageHref']) ? $this->props['imageHref'] : '';
        $artwork_href = isset($this->props['artworkHref']) ? $this->props['artworkHref'] : '';
        $artwork_title = isset($this->props['artworkTitle']) ? $this->props['artworkTitle'] : '';
        $artist_avatar = isset($this->props['artistAvatar']) ? $this->props['artistAvatar'] : '';
        $artist_name = isset($this->props['artistName']) ? $this->props['artistName'] : '';
        $artwork_price = isset($this->props['artworkPrice']) ? number_format($this->props['artworkPrice'], 2) : '';
        $artwork_slug = isset($this->props['artworkSlug']) ? $this->props['artworkSlug'] : '';
        $artwork_is_add_to_cart = isset($this->props['addedToCart']) ? $this->props['addedToCart'] : false;

        $ICON_TO_RENDER = "";
        if ($artwork_is_add_to_cart) {
            $icon_props = array(
                "icon" => "remove-cart",
                "className" => "remove-cart-icon"
            );
            $ICON = new Icon($icon_props);
            $ICON_TO_RENDER = <<<HTML
                <a class="remove-cart" href="/remove-cart?artwork_slug=$artwork_slug">
                    {$ICON->render()}
                </a>
            HTML;
        } else {
            $icon_props = array(
                "icon" => "add-cart",
                "className" => "add-to-cart-icon"
            );
            $ICON = new Icon($icon_props);
            $ICON_TO_RENDER = <<<HTML
                <a class="add-to-cart" href="/add-to-cart?artwork_slug=$artwork_slug">
                    {$ICON->render()}
                </a>
            HTML;
        }

        return <<<HTML
            <div class="container-card">
                $ICON_TO_RENDER
                <a class="image-container" href="$artwork_href">
                    <img class="artwork-img" src="$image_href">
                </a>
                <div class="card-info">
                    <h1>$artwork_title</h1>
                    <div class="artist-info">
                        <img src="$artist_avatar">
                        <span>$artist_name<span>
                    </div>
                    <span>$ $artwork_price<span>
                </div>
            </div>
        HTML;
    }
}

?>
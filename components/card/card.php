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

        return <<<HTML
            <a href="$artwork_href" class="container-card">
                <img class="artwork-img" src="$image_href">
                <div class="card-info">
                    <h1>$artwork_title</h1>
                    <div class="artist-info">
                        <img src="$artist_avatar">
                        <span>$artist_name<span>
                    </div>
                    <span><span>
                </div>
            </a>
        HTML;
    }
}

?>
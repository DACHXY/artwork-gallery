<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/tag/tag.php";

class Hero extends Component
{
    protected function MapTags($tags)
    {
        $html = "";
        for ($i = 0; $i < count($tags); $i++) {
            $tag_props = array(
                "text" => $tags[$i]
            );

            $TAG = new Tag($tag_props);
            $html .= <<<HTML
                {$TAG->render()}
            HTML;
        }

        return $html;
    }

    public function render()
    {
        @require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
        @include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

        $artworks = getRadArtwork($pdo, 1);
        $artwork = $artworks[0];
        $artwork_name = $artwork["artwork_name"];
        $artwork_img = $artwork["image"];
        $artwork_href = "/artwork?slug=" . $artwork["artwork_slug"];
        $artwork_artist_name = $artwork["artist_name"];
        $artwork_artist_href = "/artist?slug=" . $artwork["artist_slug"];
        $tags = [$artwork["medium"]];

        // tag 取 1 個
        $subset_tag = array_slice($tags, 0, 1);
        $html_tags = $this->MapTags($subset_tag);

        return <<<HTML
            <section class="section-hero" >
                <img src="$artwork_img" alt="artwork_img">
                <div class="frame-artwork-info">
                    <a class="hero-into-artist" href="$artwork_artist_href">$artwork_artist_name</a>
                    <a class="hero-into-artwork-name" href="$artwork_href">$artwork_name</a>
                    <div class="hero-tags-artwork-info">
                        $html_tags
                    </div>
                </div>
            </section>
        HTML;
    }
}

?>
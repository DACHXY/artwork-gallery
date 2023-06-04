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
                "text" => $tags[$i]["text"],
                "href" => $tags[$i]["href"]
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
        // dummy data
        $artwork = array(
            "name" => "Spielende Kinder in einer Scheune, 1898",
            "slug" => "max-liebermann-spielende-kinder-in-einer-scheune",
            "image" => "https://d7hftxdivxxvm.cloudfront.net?height=783&quality=80&resize_to=fit&src=https%3A%2F%2Fd32dm0rphc51dk.cloudfront.net%2Fjd-Z4JgZ70WfT7iwfSWKTA%2Fnormalized.jpg&width=800",
            "artist" => array(
                "name" => "Max Liebermann",
                "slug" => "max-liebermann"
            ),
            "tags" => [
                array(
                    "text" => "Oil on canvs on cardboard",
                    "href" => "/tag/oil-on-canvs-on-cardboard"
                )
            ]
        );

        $artwork_name = $artwork["name"];
        $artwork_img = $artwork["image"];
        $artwork_href = "/artwork/" . $artwork["slug"];
        $artwork_artist_name = $artwork["artist"]["name"];
        $artwork_artist_href = "/artist/" . $artwork["artist"]["slug"];
        $tags = $artwork["tags"];
        // tag 取 2 個
        $subset_tag = array_slice($tags, 0, 2);
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
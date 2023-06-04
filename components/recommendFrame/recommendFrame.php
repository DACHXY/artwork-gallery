<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";

class RecommendFrame extends Component
{
    protected function Map($artist)
    {

        $name = $artist['name'];
        $avatar = $artist['avatar'];
        $href = "/artist/" . $artist['slug'];

        return <<<HTML
            <a class="artist-icon-name-frame" href="$href">
                <div class="rec-avatar">
                    <img src="$avatar">
                </div>
                <span>$name</span>
            </a>
        HTML;
    }

    public function render()
    {
        $artists = [
            array(
                "name" => "Shepard Fairey",
                "slug" => "shepard-fairey",
                "avatar" => "https://d7hftxdivxxvm.cloudfront.net?height=45&quality=80&resize_to=fill&src=https%3A%2F%2Fd32dm0rphc51dk.cloudfront.net%2Fw6t9gJj4pPALkRbFnEpngQ%2Flarge.jpg&width=45",
            ),
            array(
                "name" => "Katrina Sánchez",
                "slug" => "katrina-sanchez",
                "avatar" => "https://d7hftxdivxxvm.cloudfront.net?height=45&quality=80&resize_to=fill&src=https%3A%2F%2Fd32dm0rphc51dk.cloudfront.net%2Fw6t9gJj4pPALkRbFnEpngQ%2Flarge.jpg&width=45"
            ),
            array(
                "name" => "Federico Pinto Schmid",
                "slug" => "federico-pinto-schmid",
                "avatar" => "https://d7hftxdivxxvm.cloudfront.net?height=45&quality=80&resize_to=fill&src=https%3A%2F%2Fd32dm0rphc51dk.cloudfront.net%2FVwQth4iPPjYpTQj4MX8QpQ%2Flarge.jpg&width=45"
            )
        ];

        $_ARTISTS_ = '';
        foreach ($artists as $artist) {
            $_ARTISTS_ .= $this->Map($artist);
        }

        return <<<HTML
            <div class="section-recommend-artists">
                <h2 class="text-recommend-artist">Recommend Artists</h2>
                <div class="frame-artists">
                    $_ARTISTS_
                </div>
                <a class="text-underline" href="/artist">
                    <div class="line-container">
                        <div class="line"></div>
                        <div class="line__top"></div>
                        <div class="line__bottom"></div>
                    </div>
                    <span>See more</span>
                </a>
            </div>
        HTML;
    }
}

?>
<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/button/actionButton/actionButton.php";

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

        $action_button_props = array(
            'href' => "/artist",
            "text" => "See more"
        );

        $ACTION_BUTTON = new ActionButton($action_button_props);

        return <<<HTML
            <div class="section-recommend-artists">
                <h2 class="text-recommend-artist">Recommend Artists</h2>
                <div class="frame-artists">
                    $_ARTISTS_
                </div>
                {$ACTION_BUTTON->render()}
            </div>
        HTML;
    }
}

?>
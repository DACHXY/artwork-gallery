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
        $href = "/gallery?artist=" . $artist['slug'];

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
        @require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
        @include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

        $artists = getRadArtist($pdo, 3);
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
                <h2 class="text-recommend-artist">Find Artists</h2>
                <div class="frame-artists">
                    $_ARTISTS_
                </div>
                {$ACTION_BUTTON->render()}
            </div>
        HTML;
    }
}

?>
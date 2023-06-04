<?php
@require_once $_SERVER['DOCUMENT_ROOT'] . "/global/baseComponent.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/components/icons/icons.php";

class MyFavorite extends Component
{
    public function render()
    {
        return <<<HTML

        HTML;
    }
}

class UserAvatar extends Component
{

    public function render()
    {
        // $user = null;

        $user = array(
            "username" => "danny",
            "avatar" => "https://d7hftxdivxxvm.cloudfront.net?height=90&quality=50&resize_to=fill&src=https%3A%2F%2Fd32dm0rphc51dk.cloudfront.net%2F-LJyO0peWclsuXcMkRUX4Q%2Flarge.jpg&width=90"
        );

        // 使用者未登入
        if ($user == null) {
            $icon_props = array(
                "icon" => "user-default",
                "className" => "user-icon-default"
            );

            $icon = new Icon($icon_props);
            return <<<HTML
                <div class="container-user-avatar">
                    <a href="/my" class="container-user-avatar">
                        {$icon->render()}
                    </a>
                    <div class="user-info">
                        <span>Log In</span>
                    </div>
                </div>
            HTML;
        }

        $MY_FAV = new MyFavorite();
        $user_avatar = $user["avatar"];
        $user_name = strtoupper($user["username"]);

        return <<<HTML
            <div class="container-user-avatar">
                <a href="/my">
                    <img src="$user_avatar" alt="User Avatar">
                </a>
                <div class="user-info">
                    <span>$user_name</span>
                </div>
            </div>
        HTML;
    }
}
?>
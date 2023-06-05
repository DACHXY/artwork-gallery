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

        $username = $_SESSION["username"];
        $user_avatar = $_SESSION["avatar"];
        $email = $_SESSION["email"];
        $username = strtoupper($username);

        // 使用者未登入
        if ($username == null || empty(trim($username))) {
            $icon_props = array(
                "icon" => "user-default",
                "className" => "user-icon-default"
            );

            $icon = new Icon($icon_props);
            return <<<HTML
                <div class="container-user-avatar">
                    <a class="user-avatar" href="/login">
                        {$icon->render()}
                    </a>
                </div>
            HTML;
        }

        $MY_FAV = new MyFavorite();
        $icon_props = array(
            "icon" => "logout",
            "className" => "logout-icon"
        );

        $icon = new Icon($icon_props);

        return <<<HTML
            <div class="container-user-avatar">
                <a class="user-avatar" href="/my">
                    <img src="$user_avatar" alt="User Avatar">
                </a>
                <div class="user-info">
                    <span class="info-item primary">$username</span>
                    <span class="info-item secondary">$email</span>
                    <a class="logout" href="/logout">
                        {$icon->render()}
                        <span>Log out</span>
                    </a>
                </div>
            </div>
        HTML;
    }
}
?>
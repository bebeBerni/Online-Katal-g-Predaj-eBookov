<?php
class Menu {
    public static function getMenu() {
        $menu = [
            'Home' => "#section_1",
            'The Book' => "#section_2",
            'Author' => "#section_3",
            'Reviews' => "#section_4",
            'Contact' => "#section_5",
        ];

        $novy = '<ul class="navbar-nav ms-lg-auto me-lg-4">';
        foreach ($menu as $name => $link) {
            $novy .= "<li class='nav-item'><a class='nav-link click-scroll' href='$link'>$name</a></li>";
        }
        $novy .= '</ul>';

        return $novy;
    }

    public static function getSocials() {
        $social = [
            'bi-instagram' => "#",
            'bi-twitter'   => "#",
            'bi-facebook'  => "#",
            'bi-whatsapp'  => "#"
        ];

        $novy = '<ul class="social-icon mb-4">';
        foreach ($social as $icon => $link) {
            $novy .= "<li class='social-icon-item'><a href='$link' class='social-icon-link $icon'></a></li>";
        }
        $novy .= '</ul>';

        return $novy;
    }

    public static function getSidebar() {
        $chapters = [
            '#item-1' => 'Introduction',
            '#item-2' => 'Chapter 1: <strong>Win back your time</strong>',
            '#item-3' => 'Chapter 2: <strong>Work less, do more</strong>',
            '#item-4' => 'Chapter 3: <strong>Delegate</strong>',
            '#item-5' => 'Chapter 4: <strong>Habits</strong>'
        ];

        $novy = '<nav id="navbar-example3" class="h-100 flex-column align-items-stretch">';
        $novy .= '<nav class="nav nav-pills flex-column">';
        
        foreach ($chapters as $link => $title) {
            $novy .= "<a class='nav-link smoothscroll' href='$link'>$title</a>";
        }

        $novy .= '</nav></nav>';
        return $novy;
    }
}
?>
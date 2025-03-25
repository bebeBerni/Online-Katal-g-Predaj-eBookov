<?php
function get_sidebar() {
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
?>
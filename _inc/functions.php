<?php
function getMenu(){

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
?>
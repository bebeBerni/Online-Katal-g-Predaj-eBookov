<?php
function get_socials(){
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
?>
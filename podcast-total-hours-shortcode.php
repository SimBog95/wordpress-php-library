// Total hours of the episodes on the website

function podcast_total_hours_shortcode() {
    $args = [
        'post_type' => 'podcast',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'fields' => 'ids'
    ];

    $posts = get_posts($args);
    $total_seconds = 0;

    foreach ($posts as $post_id) {
        $duration = get_post_meta($post_id, 'duration', true);
        if (!$duration) continue;

        $parts = array_reverse(explode(':', $duration));
        if (isset($parts[0])) $total_seconds += intval($parts[0]);
        if (isset($parts[1])) $total_seconds += intval($parts[1]) * 60;
        if (isset($parts[2])) $total_seconds += intval($parts[2]) * 3600;
    }

    $hours = floor($total_seconds / 3600);
    return $hours;
}
add_shortcode('podcast_total_hours', 'podcast_total_hours_shortcode');

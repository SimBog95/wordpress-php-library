// Add the episode podcast hours to Episodes main page
add_filter('get_the_date', function($date, $format, $post) {
    if (!is_admin() && $post && get_post_type($post) === 'podcast') {
        $duration = get_post_meta($post->ID, '_duration', true);
        if (!$duration) $duration = get_post_meta($post->ID, 'duration', true);
        if ($duration) {
            $parts = explode(':', $duration);
            if (count($parts) === 3) {
                $formatted = intval($parts[0]) . 'h' . $parts[1];
            } elseif (count($parts) === 2) {
                $formatted = $parts[0] . 'min' . $parts[1];
            } else {
                $formatted = $duration;
            }
            $clock = '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#0d1238" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
            $calendar = '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#0d1238" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>';
            $date = $clock . ' ' . $formatted . ' &nbsp;·&nbsp; ' . $calendar . ' ' . $date;
        }
    }
    return $date;
}, 10, 3);

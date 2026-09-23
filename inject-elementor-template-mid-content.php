// Add custom section inside the episode posts

add_filter( 'the_content', 'inject_template_mid_content' );

function inject_template_mid_content( $content ) {

    // Only run on single post pages (change 'post' to your CPT slug if needed, e.g. 'episode')
    // Using is_single() to catch all post types — narrow it down once you confirm it works
    if ( ! is_singular( 'podcast' ) ) return $content;

    // The ID of the Elementor template you want to inject
    $template_id = 7618;

    // Force Elementor's frontend to load so the template renders correctly
    \Elementor\Plugin::instance()->frontend->enqueue_scripts();

    // Use Elementor's built-in method to render the template into HTML
    $template_html = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id );

    // If the template returned empty, bail out to avoid breaking the content
    if ( empty( $template_html ) ) return $content;

    // Split the post content into an array, using closing paragraph tags as the separator
    $paragraphs = explode( '</p>', $content );

    // The paragraph number after which the template will be injected
    // Set to 1 for testing (injects after the 1st paragraph) — increase once confirmed working
    $inject_after = 2;

    // Only inject if the content has enough paragraphs to reach the injection point
    if ( count( $paragraphs ) > $inject_after ) {
        // Append the Elementor template HTML right after the target paragraph
        $paragraphs[ $inject_after ] .= $template_html;
    }

    // Reassemble the paragraphs back into a single content string and return it
    return implode( '</p>', $paragraphs );
}

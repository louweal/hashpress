<?php
// register rest routes
add_action('rest_api_init', function () {
    register_rest_route('hedera_leaderboard/v1', '/set_data', array(
        'methods' => 'POST',
        'callback' => 'hashpress_theme_set_leaderboard_data',
        'permission_callback' => 'hashpress_theme_validate_nonce'
    ));
    register_rest_route('hedera_leaderboard/v1', '/get_data', array(
        'methods' => 'GET',
        'callback' => 'hashpress_theme_get_leaderboard_data',
        'permission_callback' => 'hashpress_theme_validate_nonce'
    ));
});

function hashpress_theme_validate_nonce(WP_REST_Request $request)
{
    $nonce = $request->get_header('X-WP-Nonce');
    if (wp_verify_nonce($nonce, 'wp_rest')) {
        return true;
    }
    return new WP_Error('rest_forbidden', __('Invalid nonce.'), ['status' => 403]);
}

function hashpress_theme_set_leaderboard_data(WP_REST_Request $request)
{

    $data = $request->get_param('data');
    $fetched_at = $request->get_param('fetchedAt');

    if (!$data) {
        return new WP_Error('missing_data', 'Data is required', ['status' => 400]);
    }

    if (!$fetched_at) {
        return new WP_Error('missing_fetched_at', 'FetchedAt is required', ['status' => 400]);
    }

    delete_old_leaderboard_transients();

    $saved_data = set_transient("leaderboard_data", $data, 12 * HOUR_IN_SECONDS);
    if (!$saved_data) {
        return new WP_Error('save_failed', 'Failed to save data', ['status' => 500]);
    }

    $saved_date = set_transient("leaderboard_fetched_at", $fetched_at, 12 * HOUR_IN_SECONDS);

    if (!$saved_date) {
        return new WP_Error('save_failed', 'Failed to save fetch date', ['status' => 500]);
    }

    return rest_ensure_response(['success' => true]);
}

function delete_old_leaderboard_transients()
{
    global $wpdb;
    $prefix = 'leaderboard_data_';

    // Fetch all transients matching the pattern
    $transient_keys = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT option_name FROM $wpdb->options WHERE option_name LIKE %s",
            '_transient_' . $prefix . '%'
        )
    );

    // Loop through and delete each transient
    foreach ($transient_keys as $key) {
        $transient_name = str_replace('_transient_', '', $key);
        delete_transient($transient_name);
    }
}

function hashpress_theme_get_leaderboard_data()
{
    $data = get_transient("leaderboard_data");

    if (!$data) {
        return new WP_REST_Response(['error' => 'Data not found'], 404);
    }

    return new WP_REST_Response($data, 200);
}

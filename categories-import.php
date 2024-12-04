<?php
if (isset($_POST['awci_import_csv']) && !empty($_FILES['csv_file']['tmp_name']) && !empty($_POST['mapping'])) {
    $csv_file = $_FILES['csv_file']['tmp_name'];
    $mapping = $_POST['mapping'];

    if (($file_handle = fopen($csv_file, 'r')) !== false) {
        $header = fgetcsv($file_handle);

        // Load required WordPress functions
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        while (($row = fgetcsv($file_handle, 0, ',')) !== false) {
            $category_name   = isset($mapping['category_name']) ? sanitize_text_field(trim($row[$mapping['category_name']])) : '';
            $slug            = isset($mapping['slug']) ? sanitize_title(trim($row[$mapping['slug']])) : '';
            $parent_category = isset($mapping['parent_category']) ? sanitize_text_field(trim($row[$mapping['parent_category']])) : '';
            $description     = isset($mapping['description']) ? sanitize_textarea_field(trim($row[$mapping['description']])) : '';
            $thumbnail_url   = isset($mapping['thumbnail_url']) ? esc_url_raw(trim($row[$mapping['thumbnail_url']])) : '';

            $parent_id = 0;
            if (!empty($parent_category)) {
                $parent_term = get_term_by('name', $parent_category, 'product_cat');
                $parent_id = $parent_term ? $parent_term->term_id : 0;
            }

            $term = wp_insert_term($category_name, 'product_cat', [
                'slug'        => $slug,
                'parent'      => $parent_id,
                'description' => $description,
            ]);

            if (!is_wp_error($term)) {
                $term_id = $term['term_id'];
                if (!empty($thumbnail_url)) {
                    $attachment_id = media_sideload_image($thumbnail_url, 0, null, 'id');
                    if (!is_wp_error($attachment_id)) {
                        update_term_meta($term_id, 'thumbnail_id', $attachment_id);
                    }
                }
            }
        }

        fclose($file_handle);
        echo '<div class="notice notice-success is-dismissible"><p>Categories imported successfully!</p></div>';
    }
}

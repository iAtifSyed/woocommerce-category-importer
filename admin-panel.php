<?php
// Add a custom menu item for the plugin
function awci_add_admin_menu() {
    add_menu_page(
        'Category Import', 
        'Category Import', 
        'manage_options', 
        'awci-category-import', 
        'awci_render_admin_panel', 
        'dashicons-category', 
        25
    );
}
add_action('admin_menu', 'awci_add_admin_menu');

// Render the admin panel
function awci_render_admin_panel() {
    ?>
    <div class="awci-admin-panel">
        <div class="awci-header">
            <h1>WooCommerce Category Import with Mapping</h1>
            <p>Upload a CSV file and map its columns to WooCommerce category fields for bulk import.</p>
        </div>
        <div class="awci-main">
            <form method="post" enctype="multipart/form-data" id="awci-import-form">
                <label for="csv_file">Upload CSV File:</label>
                <input type="file" name="csv_file" id="csv_file" accept=".csv" required />

                <div id="awci-mapping-section" style="display: none;">
                    <h3>Map CSV Columns</h3>
                    <p>Match your CSV columns to the WooCommerce category fields:</p>
                    <table class="awci-mapping-table">
                        <tr>
                            <th>WooCommerce Field</th>
                            <th>CSV Column</th>
                        </tr>
                        <tr>
                            <td>Category Name</td>
                            <td>
                                <select name="mapping[category_name]" required></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Slug</td>
                            <td>
                                <select name="mapping[slug]" required></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Parent Category</td>
                            <td>
                                <select name="mapping[parent_category]"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>
                                <select name="mapping[description]"></select>
                            </td>
                        </tr>
                        <tr>
                            <td>Thumbnail URL</td>
                            <td>
                                <select name="mapping[thumbnail_url]"></select>
                            </td>
                        </tr>
                    </table>
                </div>

                <button type="submit" name="awci_import_csv" class="button button-primary">Import Categories</button>
            </form>
        </div>

        <div class="awci-profile">
            <h3>About Atif Syed</h3>
            <p>Hi there! I'm Atif Syed, a multi-talented developer and organic agriculture advocate. My expertise spans across technology and sustainability, blending code with care for the planet.</p>
            <p>👨‍💻 <strong>Tech Skills:</strong> WordPress, PHP, WooCommerce, JavaScript, jQuery, MySQL, MariaDB, Android Development.</p>
            <p>🌱 <strong>Nature Advocate:</strong> Organic agriculture, permaculture practices, and nature safety.</p>
            <p>🎯 <strong>Entrepreneurship:</strong> Managing multiple eCommerce stores, thriving in B2B to B2C models.</p>
            <p>🍼 <strong>Proud Father:</strong> Blessed with my son, Sultan Mustafa, born on 01 January 2024.</p>
            <a href="https://github.com/iatifsyed" target="_blank" class="button">Visit GitHub</a>
        </div>
    </div>

    <script>
        document.getElementById('csv_file').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file && file.type === 'text/csv') {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const rows = e.target.result.split("\n");
                    if (rows.length > 0) {
                        const header = rows[0].split(",");
                        const mappingSection = document.getElementById('awci-mapping-section');
                        const selects = mappingSection.querySelectorAll('select');

                        selects.forEach(select => {
                            select.innerHTML = '';
                            header.forEach((column, index) => {
                                const option = document.createElement('option');
                                option.value = index;
                                option.textContent = column.trim();
                                select.appendChild(option);
                            });
                        });

                        mappingSection.style.display = 'block';
                    }
                };
                reader.onerror = function () {
                    alert('Failed to read the file. Please upload a valid CSV file.');
                };
                reader.readAsText(file);
            }
        });
    </script>

    <style>
        .awci-admin-panel {
            padding: 20px;
            background: #fff;
            border-radius: 6px;
        }
        .awci-header {
            margin-bottom: 20px;
        }
        .awci-mapping-table {
            width: 100%;
            border-collapse: collapse;
        }
        .awci-mapping-table th, .awci-mapping-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .awci-profile {
            margin-top: 30px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
        }
    </style>
    <?php
}

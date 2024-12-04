Here's a styled version of the `README.md` file for your WooCommerce Category Importer Plugin:

---

# **WooCommerce Category Importer Plugin**  

A feature-rich WordPress plugin for bulk importing WooCommerce categories from CSV files. This plugin simplifies the process by providing an intuitive mapping interface to match your CSV columns to WooCommerce category fields.  

With this plugin, you can efficiently manage your WooCommerce store categories and streamline your workflow.  

---

## **Features**  
- **CSV Upload**: Upload CSV files for bulk category import.  
- **Mapping Interface**: Map your CSV columns to WooCommerce fields such as:  
  - Category Name  
  - Slug  
  - Parent Category  
  - Description  
  - Thumbnail URL  
- **User-Friendly Admin Panel**: Modern and intuitive admin panel design with an easy-to-navigate interface.  
- **Dynamic Column Detection**: Automatically reads CSV headers and displays them for mapping.  
- **Error Handling**: Alerts users for invalid or corrupted files.  
- **Custom Profile Section**: Includes a custom sidebar profile about the author.  

---

## **Installation**  

1. **Download or Clone the Repository**:  
   ```bash
   git clone https://github.com/iatifsyed/woocommerce-category-importer.git
   ```  

2. **Upload the Plugin**:  
   Upload the plugin folder to the `wp-content/plugins` directory of your WordPress site.  

3. **Activate the Plugin**:  
   Go to the **Plugins** section in your WordPress admin panel and activate **WooCommerce Category Importer**.  

4. **Access the Plugin**:  
   Navigate to the new **Category Import** option in the WordPress admin sidebar.  

---

## **Usage**  

### **Step 1: Upload Your CSV**  
- Open the **Category Import** panel from the WordPress admin sidebar.  
- Select and upload your CSV file with category data.  

### **Step 2: Map Your Columns**  
- After uploading, the plugin will display the CSV headers in a dropdown for mapping.  
- Map the columns to WooCommerce category fields (e.g., **Category Name**, **Slug**, **Parent Category**, etc.).  

### **Step 3: Import Categories**  
- Once the mapping is complete, click the **Import Categories** button.  
- Your WooCommerce categories will be created automatically.  

---

## **Screenshots**  

### **Admin Panel**  
<img src="screenshots/admin-panel.png" alt="Admin Panel UI" width="700">  

### **Mapping Interface**  
<img src="screenshots/mapping-interface.png" alt="Mapping Interface" width="700">  

---

## **Technical Overview**  

The plugin is built using the following technologies and methodologies:  

- **Languages**: PHP, JavaScript  
- **Frameworks**: WordPress (Plugin API), WooCommerce  
- **Frontend**: Vanilla JavaScript for dynamic mapping, HTML5, CSS3  
- **Compatibility**: Fully compatible with WooCommerce and WordPress's latest versions.  

---

## **Code Example**  

### **Register Admin Panel**  
```php
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
```  

### **JavaScript for Dynamic Mapping**  
```javascript
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
```  

## **License**  

This project is licensed under the **MIT License**.  

--- 

This layout ensures readability, professional styling, and clear navigation for developers and end-users.

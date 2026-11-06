<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];

    // Handle search results based on the submitted data
    echo "<h3>Search Results for: " . htmlspecialchars($keyword) . "</h3>";
    
    // Display the selected categories
    echo "<h4>Categories Selected:</h4>";
    if (!empty($categories)) {
        echo "<ul>";
        foreach ($categories as $category) {
            echo "<li>" . htmlspecialchars($category) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No categories selected.</p>";
    }
} else {
    echo "<p>No form data submitted.</p>";
}
?>

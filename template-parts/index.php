<?php
$content = $args['content'];
// get all headings with id=".." from the wordpress content
$pattern = '/<h([1-6])[^>]*id="([^"]+)"[^>]*>(.+?)<\/h[1-6]>/i';
preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
?>

<?php if (!empty($matches)) { ?>
    <div class="index js-index">
        <h4><?php _e('Content', 'control'); ?></h4>

        <?php //echo print_flat_list($matches);
        ?>
        <?php echo print_nested_list($matches); ?>
    </div>
<?php } ?>

<?php
function print_flat_list($matches)
{
    $html = '<ul>';
    foreach ($matches as $match) {
        $id = htmlspecialchars($match[2]);   // Get the ID of the heading
        $text = htmlspecialchars($match[3]); // Get the heading text
        $html .= "<li><a href='#$id' class='js-anchor'>$text</a></li>";
    }
    $html .= '</ul>';
    return $html;
}

// Function to print nested HTML list
function print_nested_list($matches)
{
    $current_level = 1;
    $html = '';

    foreach ($matches as $match) {
        $level = intval($match[1]); // Get heading level (1 to 6)
        $id = htmlspecialchars($match[2]); // Get the ID of the heading
        $text = htmlspecialchars($match[3]); // Get the heading text

        // Adjust the list depth based on heading level
        if ($level > $current_level) {
            $html .= str_repeat('<ul><li>', $level - $current_level);
        } elseif ($level < $current_level) {
            $html .= str_repeat('</li></ul>', $current_level - $level);
            $html .= '</li><li>';
        } else {
            $html .= '</li><li>';
        }

        // Add the list item with a link to the heading ID
        $html .= "<a href='#$id' class='js-anchor'>$text</a>";

        $current_level = $level;
    }

    // Close any remaining open lists
    if ($current_level > 0) {
        $html .= str_repeat('</li></ul>', $current_level);
    }

    return $html;
}
?>
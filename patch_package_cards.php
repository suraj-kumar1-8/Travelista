<?php
$files = [
    '/Users/surajkumar/MVC project/mvc/travelista/resources/views/packages/index.blade.php',
    '/Users/surajkumar/MVC project/mvc/travelista/resources/views/packages/partials/list.blade.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Replace div with 'a' and add href
        $content = preg_replace(
            '/<div class="glass group rounded-\[(.*?)\](.*?)data-aos="fade-up"(.*?)>/', 
            '<a href="{{ route(\'packages.show\', $package->slug) }}" class="block glass group rounded-[$1]$2data-aos="fade-up"$3>', 
            $content
        );
        
        // Replace closing div with </a> for the card. The card structure is 2 levels deep generally, but let's be careful.
    }
}

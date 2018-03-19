<?php
/**
 * RSS2 Feed Template for Yandex.News translation.
 *
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);

echo '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL;
date_default_timezone_set('utc+3');
?>
<realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
<generation-date><?php echo date('Y-m-d\TH:m:s+03:00', time()); ?></generation-date>
<?php 
while (have_posts()) : the_post();
    $post_id = get_the_ID();
    $novostrojki = false;
    $meta = get_post_meta($post_id);

    foreach (wp_get_post_terms($post_id, 'estate') as $cat) {
        if ($cat->slug == 'kvartiry' || 
            $cat->slug == 'apartamenty' ||
            $cat->slug == 'novostrojki-i-zhilye-kompleksy') {
                
            $category = 'квартира';
        } elseif (
            $cat->slug == 'doma' || 
            $cat->slug == 'ellingi') {
                
            $category = 'дом';
        } elseif ($cat->slug == 'zemelnye-uchastki') {
            $category = 'участок';
        }
    }
?>
<offer internal-id="<?php echo get_the_ID(); ?>">
    <type>продажа</type>
    <property-type>жилая</property-type>
    <category><?php echo $category; ?></category>
    <url><?php echo "http://{$_SERVER['HTTP_HOST']}/" . get_the_ID(); ?>/</url>
    <creation-date><?php echo date('Y-m-d\TH:m:s+03:00', get_the_time('U')); ?></creation-date>
    <last-update-date><?php echo date('Y-m-d\TH:m:s+03:00', get_the_modified_date('U')); ?></last-update-date>
    <payed-adv>false</payed-adv>
    <manually-added>true</manually-added>
    <location>
        <country>Россия</country>
        <region>Республика Крым</region>
        <locality-name>Ялта</locality-name>
        <address><?php echo $meta['wpcf-adres'][0]; ?></address>
        <latitude><?php echo $meta['lat'][0]; ?></latitude>
        <longitude><?php echo $meta['lng'][0]; ?></longitude>
    </location>
    <sales-agent>
        <name>Гульнара Усманова</name>
        <phone>8-978-705-3654</phone>
        <category>агентство</category>
        <organization>Агентство недвижимости ЯЛТА-ДОМ</organization>
        <url>http://ялта-дом.рф/</url>
        <email>yalta-dom.rf@yandex.ru</email>
        <photo>http://ялта-дом.рф/img/photo.png</photo>
    </sales-agent>
    <?php if ($meta['wpcf-cost-rub'][0]) : ?>
    <price>
        <value><?php echo $meta['wpcf-cost-rub'][0]; ?></value>
        <currency>RUB</currency>
    </price>
    <?php endif; ?>
    <?php if ($meta['wpcf-cost-usd'][0]) : ?>
    <price>
        <value><?php echo $meta['wpcf-cost-usd'][0]; ?></value>
        <currency>USD</currency>
    </price><?php endif; ?>
    
    <?php if ($meta['wpcf-bargain'][0] == 1) : ?><haggle>0</haggle><?php endif; ?>
    <?php if ($meta['wpcf-bargain'][0] == 2) : ?><haggle>1</haggle><?php endif; ?>
    
    <?php if ($meta['wpcf-mortgage'][0] == 1) : ?><mortgage>0</mortgage><?php endif; ?>
    <?php if ($meta['wpcf-mortgage'][0] == 2) : ?><mortgage>1</mortgage><?php endif; ?>
    
    <?php if ($meta['wpcf-prepayment'][0]) : ?><prepayment><?php echo $meta['wpcf-prepayment'][0]; ?></prepayment><?php endif; ?>
    <rent-pledge>0</rent-pledge>
    <?php if ($meta['_format_gallery_images'][0]) : ?>
        <?php foreach (unserialize($meta['_format_gallery_images'][0]) as $image) : ?>
            <?php $full_thumb = wp_get_attachment_image_src($image, 'full-thumb'); ?> 
            <image><?php echo $full_thumb[0]; ?></image>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if (($type_of_repair = mb_strtolower(types_render_field('type-of-repair'), 'utf-8')) && $type_of_repair != 'нет') : ?>
    <renovation><?php echo $type_of_repair; ?></renovation>
    <?php endif; ?>
    <description><?php echo str_replace(array('&nbsp;'), '', strip_tags(get_the_content())); ?></description>
    
    <?php if (($quality = mb_strtolower(types_render_field('quality'), 'utf-8')) && $quality != 'нет') : ?>
    <quality><?php echo $quality; ?></quality>
    <?php endif; ?>
    
    <?php if (($total_area = types_render_field('total-area')) && $total_area != 0 && has_category('doma')) : ?>
    <area>
       <value><?php echo $total_area; ?></value>
       <unit>кв.м</unit>
    </area>
    <?php endif; ?>
    
    <?php if (($living_area = types_render_field('living-area')) && $living_area != 0) : ?>
    <living-space>
        <value><?php echo $living_area; ?></value>
        <unit>кв.м</unit>
    </living-space>
    <?php endif; ?>
    
    <?php if ($rooms_area = types_render_field('rooms-area')) : ?>
        <?php foreach (explode('/', $rooms_area) as $item) : ?>
    <room-space>
        <value><?php echo $item; ?></value>
        <unit>кв.м</unit>
    </room-space>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if (($kitchen_area = types_render_field('kitchen-area')) && $kitchen_area != 0) : ?>
    <kitchen-space>
        <value><?php echo $kitchen_area; ?></value>
        <unit>кв.м</unit>
    </kitchen-space>
    <?php endif; ?>
    
    <?php if (($land_area = types_render_field('land-area')) && !empty($land_area)) : ?>
    <lot-area>
        <value><?php echo $land_area; ?></value>
        <unit>сот</unit>
    </lot-area>
    <?php endif; ?>
    
    
    
    
    <?php if ($meta['wpcf-water-in-land'][0] == 2) : ?>
    <water-supply>1</water-supply>
    <?php else : ?>
    <water-supply>0</water-supply>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-drainage-in-land'][0] == 2) : ?>
    <sewerage-supply>1</sewerage-supply>
    <?php else : ?>
    <sewerage-supply>0</sewerage-supply>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-energy-in-land'][0] == 2) : ?>
    <electricity-supply>1</electricity-supply>
    <?php else : ?>
    <electricity-supply>0</electricity-supply>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-gas-in-land'][0] == 2) : ?>
    <gas-supply >1</gas-supply >
    <?php else : ?>
    <gas-supply >0</gas-supply >
    <?php endif; ?>
    
    <?php if (($land_area = types_render_field('land-area')) && !empty($land_area)) : ?>
    <lot-area>
        <value><?php echo $land_area; ?></value>
        <unit>сот</unit>
    </lot-area>
    <?php endif; ?>
    
    
    
    
    <?php if ($meta['wpcf-object-in-the-building'][0] == 2) : ?><new-flat>1</new-flat><?php endif; ?>
    <?php if ($meta['wpcf-number-of-rooms'][0] != 0) : ?>
    <rooms><?php echo $meta['wpcf-number-of-rooms'][0]; ?></rooms>
    <rooms-offered><?php echo $meta['wpcf-number-of-rooms'][0]; ?></rooms-offered>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-open-plan'][0] == 2 && $category == 'квартира') : ?>
    <open-plan>1</open-plan>
    <?php endif; ?>
    <rooms-type>2</rooms-type>
    
    <?php if ($meta['wpcf-phone'][0] == 2) : ?>
    <phone>1</phone>
    <?php else : ?>
    <phone>0</phone>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-internet'][0] == 2) : ?>
    <internet>1</internet>
    <?php else : ?>
    <internet>0</internet>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-furniture'][0] == 2) : ?>
    <room-furniture>1</room-furniture>
    <?php else : ?>
    <room-furniture>0</room-furniture>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-furniture-in-the-kitchen'][0] == 2) : ?>
    <kitchen-furniture>1</kitchen-furniture>
    <?php else : ?>
    <kitchen-furniture>0</kitchen-furniture>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-tv'][0] == 2) : ?>
    <television>1</television>
    <?php else : ?>
    <television>0</television>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-washing-machine'][0] == 2) : ?>
    <washing-machine>1</washing-machine>
    <?php else : ?>
    <washing-machine>0</washing-machine>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-fridge'][0] == 2) : ?>
    <refrigerator>1</refrigerator>
    <?php else : ?>
    <refrigerator>0</refrigerator>
    <?php endif; ?>
    
    <?php if (($balcony = mb_strtolower(types_render_field('balcony'), 'utf-8')) && $balcony != 'нет') : ?>
    <balcony><?php echo $balcony; ?></balcony>
    <?php endif; ?>
    
    <?php if (($type_of_bathrooms = mb_strtolower(types_render_field('type-of-bathrooms'), 'utf-8')) && $type_of_bathrooms != 'нет') : ?>
    <bathroom-unit><?php echo $type_of_bathrooms; ?></bathroom-unit>
    <?php endif; ?>
    
    <?php if (($floor_covering = mb_strtolower(types_render_field('floor-covering'), 'utf-8')) && $floor_covering != 'нет') : ?>
    <floor-covering><?php echo $floor_covering; ?></floor-covering>
    <?php endif; ?>
    
    <?php if (($view_from_the_window = mb_strtolower(types_render_field('view-from-the-window'), 'utf-8')) && $view_from_the_window != 'нет') : ?>
    <window-view><?php echo $view_from_the_window; ?></window-view>
    <?php endif; ?>
    
    <?php if (($floor = types_render_field('floor')) && $floor != 0) : ?>
    <floor><?php echo $floor; ?></floor>
    <?php endif; ?>
    
    <?php if (($max_floor = types_render_field('max-floor')) && $max_floor != 0 && strpos($max_floor, '-') === false && strpos($max_floor, ' ') === false) : ?>
    <floors-total><?php echo $max_floor; ?></floors-total>
    <?php endif; ?>
    
    <?php if (($building_type = types_render_field('building-type')) && $building_type != 'Нет') : ?>
    <building-type><?php echo $building_type; ?></building-type>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-lift'][0] == 2) : ?>
    <lift>1</lift>
    <?php else : ?>
    <lift>0</lift>
    <?php endif; ?>
    
    <rubbish-chute>0</rubbish-chute>
    
    <?php if ($meta['wpcf-is-elite'][0] == 2) : ?>
    <is-elite>1</is-elite>
    <?php else : ?>
    <is-elite>0</is-elite>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-parking'][0] == 2) : ?>
    <parking>1</parking>
    <?php else : ?>
    <parking>0</parking>
    <?php endif; ?>
    
    <?php if ($meta['wpcf-alarm'][0] == 2) : ?>
    <alarm>1</alarm>
    <?php else : ?>
    <alarm>0</alarm>
    <?php endif; ?>
    
    <?php if (($ceiling_height = types_render_field('ceiling-height')) && $ceiling_height != 0) : ?>
    <ceiling-height><?php echo $ceiling_height; ?></ceiling-height>
    <?php endif; ?>
</offer>
<?php endwhile;  ?>
</realty-feed>
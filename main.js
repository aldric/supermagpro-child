var BreadcrumbGenerator = function() {
    this.generate = function() {
        var breadCrumb = {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": []
        };

        jQuery('div#supermag-breadcrumbs a').each(function(index) {
            breadCrumb.itemListElement.push({
                "@type": "ListItem",
                "position": (index + 1),
                "item": {
                    "@id": jQuery(this).attr("href"),
                    "name": jQuery(this).text()
                }
            });
        });
        return JSON.stringify(breadCrumb);
    }

    this.createJsonLdTag = function() {
        jQuery("body").append(jQuery("<script></script>").attr("type", "application/ld+json").text(this.generate()));
    };
}

jQuery(document).on('ready', function() {
    var breadcrumbGenerator = new BreadcrumbGenerator();
    breadcrumbGenerator.createJsonLdTag();

    jQuery('nav#site-navigation.main-navigation').css({
        "position": "fixed",
        "top": "0",
        "width": "100%",
        "z-index": '999',
        'left': '0'
    });

    jQuery('body').css({
        "padding-top": "50px"
    });
    //jQuery('.supermag-enable-sticky-menu .header-main-menu').width(main_navigation_width);
    //jQuery('.supermag-enable-sticky-menu .header-main-menu').css('margin', '0 auto');
    //jQuery('.sm-up-container').show();

});

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
});

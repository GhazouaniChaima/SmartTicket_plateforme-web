(function ($) {
    "use strict";

    jQuery(document).ready(function () {
        if ($().isotope && ($('.ct-js-gallery').length > 0)) {

            var $container = $('.ct-js-gallery'), // object that will keep track of options
                isotopeOptions = {}, // defaults, used if not explicitly set in hash
                defaultOptions = {
                    filter: '*', itemSelector: '.ct-gallery-item', // set columnWidth to a percentage of container width
                    masonry: {
                    }
                };

            $container.imagesLoaded().progress(function (instance, image) {
                if (!image.isLoaded) {
                    return;
                }

                var p = $(image.img).closest('.hidden');
                p.removeClass('hidden');
                $container.addClass('is-loaded');

                // set up Isotope
                $container.each(function () {
                    $(this).isotope(defaultOptions);
                    $container.isotope('layout');
                });

                $container.isotope('layout');
            }).always(function (instance) {
                if($().infinitescroll){
                    $container.infinitescroll({
                        loading: {
                            finished: undefined,
                            //img: "data:image/gif;base64,R0lGODlhHgAeAJEDAP///5mZmU1NTQAAACH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpkNTZiNzRiZC1lOTVmLTIyNDUtYmNhMS00Y2M2YjdlOTNlZmYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QkE1QTAxRUJGNDhBMTFFMkFGNTNBNDUzMDREQkY3QjUiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QkE1QTAxRUFGNDhBMTFFMkFGNTNBNDUzMDREQkY3QjUiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjgwYzk2NDRjLWJhYTktNGQ0Yy1hYTc2LTk3NjY0MGI5ZjUwYyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpkNTZiNzRiZC1lOTVmLTIyNDUtYmNhMS00Y2M2YjdlOTNlZmYiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4B//79/Pv6+fj39vX08/Lx8O/u7ezr6uno5+bl5OPi4eDf3t3c29rZ2NfW1dTT0tHQz87NzMvKycjHxsXEw8LBwL++vby7urm4t7a1tLOysbCvrq2sq6qpqKempaSjoqGgn56dnJuamZiXlpWUk5KRkI+OjYyLiomIh4aFhIOCgYB/fn18e3p5eHd2dXRzcnFwb25tbGtqaWhnZmVkY2JhYF9eXVxbWllYV1ZVVFNSUVBPTk1MS0pJSEdGRURDQkFAPz49PDs6OTg3NjU0MzIxMC8uLSwrKikoJyYlJCMiISAfHh0cGxoZGBcWFRQTEhEQDw4NDAsKCQgHBgUEAwIBAAAh+QQFCgADACwAAAAAHgAeAAACa4Rvo8LNOpxDCMpmr6AnXy9xyaKBk2hi5CUC6bOGaOy82xyVtAr1/g8MCofEojGATCKNuYtSydQInsmohro0SrEBqxPrlXDDjrFWx0yr1+yg1GZ772BNqQQ+t+Prdp6c3yewF3iXF4f2J1UAACH5BAUKAAMALAAAAAATABMAAAIzjG+jwM2I1HAOHkmbTSuDHWAeKGZkZ24lJbXuC8fy7Ar2bdM4ru/57PvJgoKez7hD8mYFACH5BAUKAAMALAAAAAAeAAgAAAIrlG+jwc06gJwSIegcpNQenD0KN3nJEgYbCZgCGK6kC2cyR6PxyOZDquKRCgAh+QQFCgADACwLAAAAEwATAAACM5Rvo8HNiNRwDh5Jm00rhy1gHihmZGduJSW17gvH8ky7wI3fdJ7vvD77AWVCgO935CVzBQAh+QQFCgADACwWAAAACAAeAAACHZSPqcvtPaKctMqAs968+w9+1kgC5omm6sq2blsAACH5BAUKAAMALAsACwATABMAAAI3nI8jy5vf2kuRTVTdNVlsnn1K+HXiiaYTwLbsEcRy7LrwLNftjQf6a+jRfjzcD1CcHZM5YlBYAAAh+QQFCgADACwAABYAHgAIAAACK4Rvo8HNOoScEiHoHKTUHpw9Cjd5yRIGGymYABiupAtnMkej8cjmQ6rikQoAIfkEBQoAAwAsAAALABMAEwAAAjeEb6PLg9jiO7HNVNcFWd+ubKDzjeaJpkrAtuwixHLsuvAs1+2NC/qr6NF+PNwvUJwdkzliUFgAADs=",
                            finishedMsg: "<div class='gallerymessage'>No more images</div>",
                            msg: null,
                            msgText: "<div class='gallerymessage'>Loading</div>",
                            selector: null,
                            speed: 'fast',
                            start: undefined
                        },
                        navSelector: ".wp-pagenavi",
                        nextSelector: ".nextpostslink",
                        itemSelector: ".ct-gallery-item",
                        extraScrollPx: 0,
                        prefill: true
                    }, function( newElements ) {
                        $container.imagesLoaded(function(){
                            $(newElements).removeClass('hidden');
                            $container.isotope('appended', $(newElements));

                        });
                    });
                }
            });

            $('.ct-js-gallery-filters a').click(function () {
                $('.ct-js-gallery-filters .active').removeClass('active');
                $(this).addClass('active');

                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter: selector, animationOptions: {
                        duration: 750, easing: 'linear', queue: false
                    }
                });
                return false;
            });

            var selects, checkbox;
            var filters = {};

            $( ".ct-js-gallery-filters .selectized").change(function () {
                selects = $(".ct-js-gallery-filters").find(".selectized");
                filters = {};
                for(var i = 0; selects.length > i ; i++){
                    filters["something"+i] = $(selects[i]).find("option").attr("value")
                }
                var filterValue = concatValues(filters);
                $container.isotope({
                    filter: filterValue
                });
            }).change();

            var value = [];
            var filtered_items;
            $( ".ct-js-gallery-filters .ct-checbox--custom").each(function () {
                var input, main_parent;
                input = $(this).find("input");
                var value_objects = {};
                input.on("click", function(){

                    main_parent = input.parent().parent().parent().parent().parent();
                    value_objects["value"] = "."+input.attr("value").toLowerCase().replace(/\s+/g, '');
                    value_objects["group"] = main_parent.attr("data-group");
                    for(var i = 0; value.length > i; i++){
                        if(value[i].group == value_objects.group){
                            value.splice($.inArray(value[i], value),1)
                        }
                    }
                    value.push(value_objects);
                    main_parent.find("input").prop('checked', false);
                    $(this).prop('checked', true);
                    var filterValue = concatValuesArray(value);
                    $container.isotope({
                        filter: filterValue
                    });
                    filtered_items = $container.data('isotope').filteredItems;
                    resultsCounter(filtered_items.length);
                })
            });
            var pass = false;
            var number;
            var number_check, date_check;
            $(".ct-js-gallery-filters").each(function(){
                var selector = $(this);
                var range_slider = $(this).find('.ct-js-nstSlider-isotope');
                var data_rounding = range_slider.attr("data-rounding");
                var data_group_type = range_slider.attr("data-group_type");
                if(range_slider.length != 0){
                    range_slider.nstSlider({
                        "rounding": data_rounding,
                        "left_grip_selector": ".leftGrip",
                        "right_grip_selector": ".rightGrip",
                        "value_bar_selector": ".bar",
                        "highlight": {
                            "grip_class": "gripHighlighted",
                            "panel_selector": ".highlightPanel"
                        },
                        "value_changed_callback": function(cause, leftValue, rightValue) {
                            selector.find('.leftLabel').text(leftValue);
                            selector.find('.rightLabel').text(rightValue);
                            if(pass){
                                $container.isotope({ filter: function() {
                                    if(typeof(filtered_items) == "undefined"){
                                        findItem($(this), data_group_type, leftValue, rightValue);
                                    }else{
                                        for(var i = 0; filtered_items.length > i;i++){
                                            if(filtered_items[i].element.className == $(this)[0].className){
                                                findItem($(this), data_group_type, leftValue, rightValue);
                                            }else{
                                                number_check = false;
                                            }
                                        }
                                    }
                                    return number_check
                                } })
                                resultsCounter($container.data("isotope").filteredItems.length);
                            }
                            pass = true;
                        }
                    });
                }
            });
            if($(".ct-js-datepicker").length != 0){
                datepicker_range.on("select", function(data){
                    var date_from = arguments[0].fromDate;
                    var date_to = arguments[0].toDate;

                    $container.isotope({ filter: function() {
                        var date = new Date($(this).find('.ct-date').text());

                        if(typeof(filtered_items) == "undefined"){
                            date_check = date_from <= date && date <= date_to
                        }else{
                            for(var i = 0; filtered_items.length > i;i++){
                                if(filtered_items[i].element.className == $(this)[0].className){

                                }else{
                                    date_check = false;
                                }
                            }
                        }
                        return date_check
                    } });
                    resultsCounter($container.data("isotope").filteredItems.length);
                })
            }
        }
        // flatten object by concatting values
        function concatValues( obj ) {
            var value = '';
            for ( var prop in obj ) {
                value += obj[ prop ];
            }
            return value;
        }
        function concatValuesArray( array ) {
            var value = '';
            for ( var prop in array ) {
                value += array[prop].value;
            }
            return value;
        }
        function findItem(selector, type, leftValue, rightValue){
            if(type == "price"){
                number = parseInt(selector.find('.ct-currency').text().replace('$', ''), 10);
                number_check = leftValue <= number && number <= rightValue;
            }else if(type == "days"){
                number = parseInt(selector.find('.ct-days').text().replace('$', ''), 10);
                number_check = leftValue <= number && number <= rightValue;
            }
        }
        function resultsCounter(count){
            var results_text = "<span class='ct-fw-600'>"+count+"</span> <span>results found.</span>";
            $(".ct-results-left .ct-results-counter * ").remove();
            $(".ct-results-left .ct-results-counter").append(results_text);
        }

    });
}(jQuery));
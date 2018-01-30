$(document).ready(function(){

    function getPath() {//alert();
        var page_string = "?page={{#}}";
        var url;
        if(typeof($('#myurl')[0]) !== "undefined" && $('#myurl')[0] !== null) {
            console.log('in if');
            url = $("#myurl").data('value');
        }
        else {
            console.log('in else');            
            url = 'http://10.42.0.40/taggify-laravel/public/user_contents';            
        }
        if(url.endsWith('&page={{#}}')){
            $("#myurl").attr('data-value', 'http://10.42.0.40/taggify-laravel/public/user_contents');
            return url;
        }
        return url + page_string;
    }
    
    var $grid = $('.grid').masonry({
        itemSelector: '.photo-item',
        columnWidth: '.grid__col-sizer',
        gutter: '.grid__gutter-sizer',
        percentPosition: true,
        stagger: 30,
        // nicer reveal transition
        visibleStyle: { transform: 'translateY(0)', opacity: 1 },
        hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
    });

    var msnry = $grid.data('masonry');                            
        $grid.infiniteScroll({
            path: getPath(),
            responseType: 'text',
            outlayer: msnry,
            status: '.page-load-status',
            history: false,
        });
    if(typeof($('.grid')[0]) !== "undefined" && $('.grid')[0] !== null)
    {
        $grid.on('load.infiniteScroll', function( event, response ) {
            var data = JSON.parse( response );
            var itemsHTML = data.data.map( getItemHTML ).join('');
            var $items = $( itemsHTML );
            $items.imagesLoaded( function() {
                //console.log("in imagesLoaded : ");
                $grid.infiniteScroll( 'appendItems', $items )
                .masonry( 'appended', $items );
            })
        });
                    
        $grid.data('infiniteScroll').pageIndex = 0;

        $grid.infiniteScroll('loadNextPage');

        var itemTemplateSrc = $('#photo-item-template').html();
    }

    $('#tag_search_btn').click(function(){
        $('.photo-item').each(function(){
            $(this).remove();
        });

        let tags = new Set();
        $('a.label').each(function(){
            tags.add($(this).data('value'));
        });
        
        tags = Array.from(tags);

        $grid.data('infiniteScroll').pageIndex = 0;       

        $("#myurl").data('value', 'http://10.42.0.40/taggify-laravel/public/user_contents?first=true&tags=' + JSON.stringify(tags)) + '&page={{#}}';
        window.location = $("#myurl").data('value');

        $grid.infiniteScroll('loadNextPage');
    });

    function getItemHTML( photo ) {
        return microTemplate( itemTemplateSrc, photo );
    }
     
    function microTemplate( src, data ) {
        return src.replace( /\{([\w\-_\.]+)\}/gi, function( match, key ) {
            if(key === "file_name"){
                if(typeof($('#myurl')[0]) !== "undefined" && $('#myurl')[0] !== null) {
                    data.file_name = 'http://10.42.0.40/taggify-laravel/public/' + data.file_name.replace('public', 'storage');
                }
                else {
                    data.file_name = data.file_name.replace('public', 'storage');
                }                
                return data.file_name;                                        
            }
            else if(key === "tags"){
                let tags = data.tags;
                let aTags = "";
                for(i = 0; i < tags.length; i++){
                    aTags += "<a target='_blank' href='user_contents/?tags=" + tags[i] + "'><span style='font-weight: bold; text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;'>#" + tags[i] + "</a> ";
                }
                return aTags;
            }
        });
    }
});
jQuery(function($) {
    $('document').ready(function(){
        function getUrlVars(){
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i< hashes.length; i++){
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
        $('tr').on('click',function(){
            $(this).toggleClass('table-active');
        });
        $('td').each(function(){
            if($(this).text() !== '&nbsp;'){
                $(this).html($(this).html().replace(/&nbsp;/g, ''));
            }
        });
        $('.status').each(function(){
           if($(this).html() == 0){
               console.log('bad order found');
               $(this).html('<i class="fa fa-warning fail"></i>');
           } else {
               $(this).html('<i class="fa fa-check success"></i>');
           }
        });
        $('.christmas').each(function(){
           if($(this).html('0')){
               $(this).html('-');
           } else {
               $(this).html('<i class="fa fa-check-circle success"></i>');
           }
        });
        $('#select_all').on('click', function(){
            if($(this).hasClass('s_active')){
                $('tr').each(function(){
                    $(this).removeClass('table-active');
                });
            } else {
                $('tr').each(function(){
                    $(this).addClass('table-active');
                });
            }
            $(this).toggleClass('s_active');
        });

        $('#print').on('click', function(){
           if($('.table-active').length){
               $('h1, div.container div.row:odd').addClass('printSpecial').printArea({ popClose: true });
           } else {
               $('h1, div.container div.row:odd').printArea({ popClose: true });
           }
        });
        $('#export').on('click', function(){

        });
        $('thead th').each(function(){
            $id = $(this).attr('id');
            $page = getUrlVars()['page'];
            $current = window.location.href.indexOf('='+$id);
            $order = window.location.href.indexOf('&order=DESC');
            $aorder = window.location.href.indexOf('$order=ASC');
            console.log('current page is ' + $page);
            console.log($current);
            if($aorder > $order){
                console.log('going down');
                $(this).wrapInner('<a href="index.php?page='+ $page +'&sort='+ $id +'&order=DESC"></a>');
            } else {
                console.log('going up');
                $(this).wrapInner('<a href="index.php?page='+ $page +'&sort='+ $id +'&order=ASC"></a>');
            }
        });
    });
});
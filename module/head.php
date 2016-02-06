
<link type="text/css" rel="stylesheet" href="css/style.css" />
<link type="text/css" rel="stylesheet" href="css/jquery.mmenu.all.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script>
<script type="text/javascript">
    $(function() {
        $("nav#menu")
                .mmenu({
                    extensions 		: [ "pageshadow", "theme-white" ],
                    counters		: true,
                    dividers		: {
                        add				: true,
                        addTo			: "[id*='contacts-']",
                        fixed			: true
                    },
                    navbar			: {
                        title			: "MENU"
                    },
                    navbars		: [{
                        content: ["searchfield"]
                    }, true]
                });

        $('a.disable').click(function(){
            return false;
        });
    });
</script>


<script>
    $(document).ready(function() { 
        var request = $.ajax({
            type: 'post',
            url: '/game/ajaxgametriviaquestionsapi',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.completed) {
                    window.location = "/winlooseordraw";
                }
            }
        });
    });
</script>
<div id="pageContainer" class="container loading-game" style="">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-12">
                <h1>Loading new Questions...</h1>
            </div>
        </div>
    </div>
</div>
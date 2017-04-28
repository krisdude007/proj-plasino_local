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
<div id="pageContainer" class="container" style="background: linear-gradient(#ffffff, #79c7db);">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-10">
                <h1>Please wait while we load new questions into the system...</h1>
            </div>
        </div>
    </div>
</div>
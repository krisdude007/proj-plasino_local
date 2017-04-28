<div id="content" style="text-align: left">
    <div style="padding:1% 1%;">
        <div style="width: 300px; margin: 0 auto;">
            <h1>UPLOAD PHOTOS</h1>
            Please select an image to upload. Images must be either .gif, .jpg or .png format.
            <?php
            $this->renderPartial('_formUpload', array(
                'uploadimage' => $uploadimage,
            ));
            ?>
        </div>
    </div>
</div>
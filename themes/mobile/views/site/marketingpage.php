<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);
?>

<?php
$env = getenv('YOUTOO_ENVIRONMENT');
if ($env == 'aws-development') {
    $url = '/winlooseordraw/51';
} else {
    $url = '/winlooseordraw/157';
}
?>
<script>
    $(document).ready(function() {
        $("#next-game-ends").countdown("<?php echo date('Y/m/d H:i:s', strtotime($game->close_date)); ?>", function(event) {
            var format = "%H:%M:%S";

            //if(event.offset.days > 0) {
            format = '%-D día%!D ' + format;
            //}

            $(this).text(event.strftime(format));
        });
    });
</script>
<div class='as-table'>
    <div class="homeTop" style="width: 100%; max-height: 51px; min-height: 51px; background-color: #292929;"><h5 style="text-align: right; margin-bottom: 0px; font-size: 16px; color: #ffffff; font-weight: lighter; float: left; margin-right: 5px;color: #f9d83d; width: 50%;"><?php echo Yii::t('youtoo', 'Participa antes de '); ?></h5><h5 id="next-game-ends" style="margin-bottom: 0px; font-size: 16px; color: #ffffff; font-weight: bolder; width: 45%; float: left;"></h5></div>

    <div style='position: relative;'>
        <a onclick="window.location = '<?php echo $url; ?>'"><img src="/webassets/mobile/images/image_azteca-concursos_background.png" style="width: 100%;"/></a>
    </div>
    <div class="homeFooter text-center as-table-row">
        <div style="background-color: #2a3335; position: relative;padding-left: 0px; padding-right: 0px; bottom: 386px;">
            <div style="margin-top: 20px;">
                <video width="100%" height="208px" controls autoplay preload="none" poster="/webassets/mobile/images/promo_image2.png">
                    <source src="<?php print ('/webassets/mobile/videos/promo_video.mp4') ?>" type="video/mp4">
                    Your browser does not support the <code>video</code> element.
                </video>
            </div>
        </div>
        <div style="background-color: #2a3335; position: relative; padding: 20px; margin: 10px; bottom: 386px;">
            <h3 style="text-align: left; color: #edbc5a;font-weight: 300;">Juego</h3>
            <p style="text-align: left; color: #ffffff; font-size: 12px;">Cada viernes y sábado, Azteca transmitirá un partido de fútbol.
                Tú tienes que escoger al ganador. Sólo cuesta $1 elegir tu
                respuesta, si ésta es correcta, entras al sorteo para ganar el
                premio semanal para este partido.</p>

            <p style="text-align: left; color: #ffffff; font-size: 12px;">Los participantes podrán elegir una opción relacionada a los
                equipos jugadores. Por ejemplo:<br/>
                Seleccionar el Equipo A, Equipo B ó Empate.</p>
        </div>
        <div style="background-color: #2a3335; position: relative; padding: 20px; margin: 10px; bottom: 386px;">
            <h3 style="text-align: left; color: #edbc5a;font-weight: 300;">Cómo participar</h3>
            <p style="text-align: left; color: #ffffff; font-size: 12px;">El sorteo para el concurso LIGA MX VIERNES
                FUTBOLERO se llevará a cabo todos los viernes a partir
                del 21 de septiembre del 2015, concluyendo 5 minutos
                antes del comienzo del partido del Viernes Futbolero.
                Las entradas al sorteo deben ser recibidas antes del
                inicio del partido del viernes.</p>
            <p style="text-align: left; color: #ffffff; font-size: 12px;">
                El sorteo para el concurso LIGA MX SABADO ESTELAR
                se llevará a cabo todos sábados a partir del 21 de
                septiembre del 2015, concluyendo 5 minutos antes
                del comienzo del partido del Sábado Estelar. Las
                entradas al sorteo deben ser recibidas antes del
                inicio del partido del sábado.
            </p>
            <p style="text-align: left; color: #ffffff; font-size: 12px;">
                Los usuarios pueden participar en el sorteo a través
                de la página web o plataforma móvil mediante el pago
                de un dólar ($ 1.00) y seleccionando la respuesta a la
                pregunta. También hay un método gratis para
                participar, consulta la página web para obtener
                más información al respecto.
            </p>
            <p style="text-align: left; color: #ffffff; font-size: 12px;">Después de registrar tu cuenta y añadir créditos por
                medio de PayPal o tarjeta de crédito, selecciona el
                sorteo para LIGA MX VIERNES FUTBOLERO. Elije quién
                crees que ganará el partido de fútbol transmitido por
                Azteca. Si seleccionas el resultado correcto, entonces
                entrarás al sorteo del premio. Los ganadores serán
                anunciados al final del partido, o al comienzo del
                siguiente partido transmitido.
            </p>
        </div>
        <div style="background-color: #2a3335; position: relative; padding: 20px; margin: 10px; bottom: 386px;">
            <h3 style="text-align: left; color: #edbc5a;font-weight: 300;">Lista de Premios</h3>
            <p style="text-align: left; color: #ffffff; font-size: 12px;">¡Puedes ganar dinero en efectivo y premios! Cada
                viernes por la noche, a partir del 21 de septiembre
                del 2015, el premio consistirá en un balón de
                fútbol autografiado con un valor aproximado\ de
                $ 150. Cada sábado por la noche, a partir del 21
                de septiembre del 2015, el premio consistirá en
                $ 1,000 en efectivo.
            </p>
        </div>
        <div style="background-color: #2a3335; position: relative; padding: 20px;margin: 10px; bottom: 386px; margin-bottom: -370px;">
            <h3 style="text-align: left; color: #edbc5a;font-weight: 300;">Selección del Ganador</h3>
            <p style="text-align: left; color: #ffffff; font-size: 12px;">Los ganadores de cada sorteo serán seleccionados
                por un sorteo al azar entre todos los participantes
                que presenten el resultado correcto del partido el
                viernes o el sábado, durante el partido de Liga MX
                Futbol correspondiente. El sorteo del premio tendrá
                lugar durante o después de que el partido haya
                oficialmente terminado y el resultado haya sido
                ofificialmente declarado.
            </p>
        </div>
    </div>
</div>

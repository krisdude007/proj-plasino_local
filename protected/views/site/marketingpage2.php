<div id="pageContainer" class="container" style="padding-left: 0px; padding-right: 0px; background-color: #1f1919; "><?php //if(isset($_GET['f'])){ echo $_GET['f']; } exit;       ?>
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <a href="/winlooseordraw/155"><img src="/webassets/images/laliga/Image_Web_viernes-futbolero_background.png" style="position: relative; top: -28px; max-width: 102.6%; left: -7px;"/>
        </a>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2" style="background-color: #040b02; position: relative; top: -383px; margin-left: 10.9333%; min-width: 660px; min-height: 200px;">
                <div style="float: left; max-width: 350px;">
                    <h3 style="text-align: left; color: #1bbc3f;font-weight: 300;">Juego</h3>
                    <p style="text-align: left; color: #ffffff; font-size: 12px;">Cada viernes y sábado, Azteca transmitirá un partido de fútbol.
                        Tú tienes que escoger al ganador. Sólo cuesta $1 elegir tu
                        respuesta, si ésta es correcta, entras al sorteo para ganar el
                        premio semanal para este partido.</p>

                    <p style="text-align: left; color: #ffffff; font-size: 12px;">Los participantes podrán elegir una opción relacionada a los
                        equipos jugadores. Por ejemplo:<br/>
                        Seleccionar el Equipo A, Equipo B ó Empate.</p>
                </div>
                <div style="float: right; margin-top: 20px;">
                    <?php
                    if (!isset($width))
                        $width = '258';
                    if (!isset($height))
                        $height = '158';
                    ?>

                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="328" height="197" allowFullScreen="true">
                        <param name="flashvars" value="file=<?php echo Yii::app()->createUrl('/webassets/videos/Azteca_30_Sec_Promo_Generic_WEB.mov') ?>&autostart=true&stretching=exactfit&autoPlay=true&controlbar=none" />
                        <param name="movie" value="/webassets/swf/player.swf" />
                        <param name="wmode" value="window" />
                        <param name="autoPlay" value="true" />
                        <embed src="/webassets/swf/player.swf"
                               width="<?php echo $width; ?>"
                               height="<?php //echo $height; ?>"
                               wmode="window"
                               type="application/x-shockwave-flash"
                               pluginspage="http://www.macromedia.com/go/getflashplayer"
                               allowFullScreen="true"
                               autoplay="true"
                               flashvars="file=<?php echo Yii::app()->createUrl('/webassets/videos/Azteca_30_Sec_Promo_Generic_WEB.mov') ?>&autostart=true&stretching=exactfit&autoPlay=true&controlbar=none" />
                    </object>
                </div>
            </div>
        </div>
        <div class="row">
            <img src="/webassets/images/laliga/image_divider.png" style="position: relative; top: -355px;"/>
            <a href="/winlooseordraw/155"><img src="/webassets/images/laliga/button_juega-ahora_viernes-futbolero.png" style="position: absolute; top: 465px; right: 320px"/></a>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2" style="background-color: #040b02; position: relative; top: -324px; margin-left: 10.9333%; min-width: 329px; min-height: 604px; margin-bottom: -200px;">
                <h3 style="text-align: left; color: #1bbc3f;font-weight: 300;">Cómo participar</h3>
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
            <div class="col-sm-4" style="background-color: #040b02; position: relative; top: -324px; margin-left: 0.9633%; min-width: 321px; min-height: 201px;">
                <h3 style="text-align: left; color: #1bbc3f;font-weight: 300;">Lista de Premios</h3>
                <p style="text-align: left; color: #ffffff; font-size: 12px;">¡Puedes ganar dinero en efectivo y premios! Cada
                    viernes por la noche, a partir del 21 de septiembre
                    del 2015, el premio consistirá en un balón de
                    fútbol autografiado con un valor aproximado\ de
                    $ 150. Cada sábado por la noche, a partir del 21
                    de septiembre del 2015, el premio consistirá en
                    $ 1,000 en efectivo.
                </p>
            </div>
            <div class="col-sm-4" style="background-color: #040b02; position: relative; top: -324px; margin-left: 0.9633%; min-width: 321px; min-height: 211px; margin-top: 10px;">
                <h3 style="text-align: left; color: #1bbc3f;font-weight: 300;">Selección del Ganador</h3>
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
</div>